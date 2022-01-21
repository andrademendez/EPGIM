<?php

namespace App\Http\Livewire;

use App\Events\Pending;
use App\Models\AttachStatusFiles;
use App\Models\Campanias;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class Challenge extends Component
{
    use WithPagination;
    use WireToast;

    public $search, $open, $action, $camp, $id_campania, $comentario;

    public function openPendiente($id)
    {
        $this->open = true;
        $this->action = 'Pendiente';
        $this->id_campania = $id;
    }

    public function openConfirmar($id)
    {
        $this->open = true;
        $this->action = 'Confirmar';
        $this->id_campania = $id;
    }

    public function confirmar()
    {
        # code...

    }
    public function closeModal()
    {
        $this->open = false;
        $this->reset(['id_campania', 'camp', 'action', 'comentario']);
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function pendiente()
    {
        $campania = Campanias::find($this->id_campania);

        try {
            $attach = AttachStatusFiles::find($campania->attachStatusFile->id);
            $attach->comment = $this->comentario;
            $attach->status = 'Pendiente';
            $attach->updated_at = now();
            $attach->save();
            if ($attach) {
                Pending::dispatch($campania->user->email, $attach->comment);
                toast()->success('Se ha enviado notificacion al creador de la campaña')->push();
                //$this->showAlert('Se ha enviado notificacion al usuario', 'success');
                $this->closeModal();
                //event
            }
        } catch (\Throwable $th) {
            //throw $th;
            //dd($this->id_campania);
            //toast()->success($this->id_campania)->push();
            toast()->success($campania->id)->push();
        }
    }

    public function render()
    {
        return view('livewire.challenge', [
            'campanias' => AttachStatusFiles::all(),
        ]);
    }

    public function showAlert($mensaje, $icons)
    {
        $this->emit('swal:alert', [
            'icon' => $icons,
            'type'    => 'success',
            'title'   => $mensaje,
            'timeout' => 3000
        ]);
    }
}