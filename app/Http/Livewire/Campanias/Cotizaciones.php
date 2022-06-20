<?php

namespace App\Http\Livewire\Campanias;

use App\Mail\ClienteCotizacion;
use App\Models\Campanias;
use App\Models\Operaciones\Cotizacion as OperacionesCotizacion;
use Illuminate\Contracts\Container\Container;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Browsershot\Browsershot;
use Usernotnull\Toast\Concerns\WireToast;

class Cotizaciones extends Component
{
    use WireToast;

    public $campania;

    public $archivo;

    public function generarPdf()
    {
        # code...


    }

    public function store()
    {
        # code...
        $campania = Campanias::find($this->campania);
        $folio = Str::random(10);

        try {
            $affected = new OperacionesCotizacion();
            $affected->folio = $folio;
            $affected->estatus = false;
            $affected->campania_id = $this->campania;
            $affected->save();
            if ($affected) {
                # code...
                $archivo = $this->PDF($campania);
                $editar = OperacionesCotizacion::find($affected->id);
                $editar->archivo = $archivo;
                $editar->save();
                if ($editar) {
                    toast()->success('PDF guardado en sistema')->push();
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->info('Error al guardar archivo')->push();
        }
    }

    public function crearPdf($datos)
    {
        # code...
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('pdf.cotizaciones', ['campanias' => $datos]);

        $random = Str::random(10);

        $path = Storage::url('cotizaciones/cotizacion-' . $random . '.pdf');
        $pdf->setPaper('a4', 'landscape')->setWarnings(false)->save('storage/cotizaciones/cotizacion-' . $random . '.pdf');

        return $path;
    }

    public function PDF($campania)
    {
        $random = Str::random(10);

        $html = view('pdf.cotiz', [
            'campanias' => $campania,
        ])->render();

        $path = Storage::url('cotizaciones/cotizacion-' . $random . '.pdf'); //

        Browsershot::html($html)->format('Letter')
            ->emulateMedia('screen')
            ->margins(10, 10, 10, 10)
            ->landscape()
            ->savePdf('storage/cotizaciones/cotizacion-' . $random . '.pdf');

        return $path;
    }

    public function enviarEmail($id)
    {
        # code...
        try {
            $affected = DB::table('cotizaciones')
                ->where('campania_id', $id)
                ->update(['estatus' => 1]);
            $campania = Campanias::find($id);
            if ($affected) {
                Mail::to($campania->cliente->email)->send(new ClienteCotizacion($campania));
                toast()->success('Correo enviado al cliente')->push();
            }
        } catch (\Throwable $th) {
            toast()->info('Error al enviar el correo al cliente')->push();
        }
    }

    public function render()
    {
        return view('livewire.campanias.cotizaciones', [
            'campanias' => Campanias::find($this->campania),
        ]);
    }
}