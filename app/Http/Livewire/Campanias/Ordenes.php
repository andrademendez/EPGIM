<?php

namespace App\Http\Livewire\Campanias;

use App\Mail\OrdenesServicios as MailOrdenesServicios;
use App\Models\Campanias;
use App\Models\Operaciones\Actividades;
use App\Models\Operaciones\OrdenesServicios;
use App\Models\Operaciones\TiposOrdenes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;

class Ordenes extends Component
{

    use WireToast;
    public $action, $open;

    public $campania_id, $actividad, $tipoOrden, $fecha_inicio, $fecha_termino, $hora_inicio, $hora_termino, $url, $comentarios, $espacio_asignado;


    protected $rules = [
        'actividad' => 'required',
        'tipoOrden' => 'required',
        'fecha_inicio' => 'required',
        'hora_inicio' => 'required',
    ];


    public function openModal()
    {
        $this->open = true;
        $this->action = 'Registrar';
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['actividad', 'tipoOrden', 'fecha_inicio', 'fecha_termino', 'hora_inicio', 'hora_termino', 'url', 'comentarios', 'espacio_asignado']);
    }

    public function store()
    {
        $this->validate();
        try {
            $orden = new OrdenesServicios();
            $orden->ubicacion = $this->espacio_asignado;
            $orden->fecha_inicio = $this->fecha_inicio;
            $orden->horario_inicio = $this->hora_inicio;
            $orden->fecha_fin = $this->fecha_termino;
            $orden->horario_fin = $this->hora_termino;
            $orden->estatus = false;
            $orden->url = $this->url;
            $orden->comentarios = $this->comentarios;
            $orden->campania_id = $this->campania_id;
            $orden->actividad_id = $this->actividad;
            $orden->tipo_orden_servicios_id = $this->tipoOrden;
            $orden->save();
            if ($orden) {

                $archivo = $this->PDF($orden);
                $editar = OrdenesServicios::find($orden->id);
                $editar->archivo = $archivo;
                $editar->save();

                if ($editar) {
                    foreach ($editar->responsables($editar->actividad_id) as $activ) {
                        # code...
                        foreach ($activ->users as  $user) {
                            # code...
                            Mail::to($user->email)->queue(new MailOrdenesServicios($editar));
                        }
                    }

                    $this->closeModal();
                    $this->resetear();
                    toast()->success('Se ha creado la orden de servicio')->push();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->info('Error al generar la orden de servicio')->push();
        }
    }


    public function crearPdf($datos)
    {
        # code...
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('pdf.ordenes.normal', ['orden' => $datos]);

        $random = Str::random(10);

        $path = Storage::url('ordenes/ordenes-' . $random . '.pdf');
        $pdf->save('storage/ordenes/ordenes-' . $random . '.pdf');

        return $path;
    }

    public function PDF($orden)
    {
        $random = Str::random(10);

        $html = view('pdf.ordenes.digital', [
            'orden' => $orden,
        ])->render();

        $path = Storage::url('ordenes/ordenes-' . $random . '.pdf'); //

        Browsershot::html($html)->format('Letter')
            ->emulateMedia('screen')
            ->margins(10, 10, 10, 10)
            ->landscape()
            ->savePdf('storage/ordenes/ordenes-' . $random . '.pdf');

        return $path;
    }

    public function render()
    {

        return view('livewire.campanias.ordenes', [

            'actividades' => Actividades::all(),
            'ordenes' => TiposOrdenes::all(),
            'campanias' => Campanias::find($this->campania_id)->ordenesServicios,
            'espacios' => DB::table('campania_espacio')
                ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
                ->where('id_campania', $this->campania_id)->get(),
        ]);
    }

    public function resetear()
    {
        $this->fecha_inicio = "";
        $this->hora_inicio = "";
        $this->fecha_termino = "";
        $this->hora_termino = "";
        $this->url = "";
        $this->comentarios = "";
        $this->actividad = "";
        $this->tipoOrden = "";
        $this->espacio_asignado = "";
    }
}