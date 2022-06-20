<?php

namespace App\Http\Livewire\Operaciones;

use App\Models\Operaciones\OrdenesServicios;
use App\Models\User;
use App\Notifications\ValidacionOrdenServicio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Facades\Notification;

class ValidarOrden extends Component
{
    use WireToast;


    public $orden_id, $open, $action, $estatus, $actividad, $comentarios;


    protected $rules = [
        'estatus' => 'required',
        'comentarios' => 'required|min:10',

    ];

    public function openModal()
    {
        # code...
        $this->open = true;
    }
    public function closeModal()
    {
        # code...
        $this->open = false;
        $this->reset(['estatus', 'comentarios']);
    }

    public function store()
    {
        $this->validate();
        # code...
        if ($this->estatus == "Validado") {
            # code...
            $this->actividad = 'Por realizar';
        } else {
            $this->actividad = 'Actividad Cancelada';
        }
        try {
            $affected = DB::table('ordenes_servicios_estatus')->insert([
                'usuario' => Auth::id(),
                'estatus' => $this->estatus,
                'actividad' => $this->actividad,
                'comentarios' => $this->comentarios,
                'orden_servicio_id' => $this->orden_id,
                'created_at' => now()
            ]);
            if ($affected) {
                $orden = OrdenesServicios::find($this->orden_id);
                $orden->estatus = true;
                $orden->save();
                if ($orden) {
                    $this->closeModal();
                    toast()->success('La orden se ha cambiado de estatus!!')->push();
                    Notification::route('mail', $orden->campania->user->email)->notify(new ValidacionOrdenServicio($orden));
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
            toast()->info('Verifique tus datos!!')->push();
        }
    }

    public function testMail()
    {
        # code...
        // Notification::route('mail', 'jandrade@delking.mx')->notify(new ValidacionOrdenServicio());
    }
    public function render()
    {
        return view('livewire.operaciones.validar-orden', [
            'orden' => OrdenesServicios::find($this->orden_id),
            'usuario' => User::find(Auth::id()),
        ]);
    }
}