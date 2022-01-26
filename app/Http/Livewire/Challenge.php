<?php

namespace App\Http\Livewire;

use App\Mail\FilePending;
use App\Mail\NotificacionConfirmacion;
use App\Models\AttachStatusFiles;
use App\Models\Campanias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class Challenge extends Component
{
    use WithPagination;
    use WireToast;

    public $search, $open, $action, $camp;
    public $id_campania, $comentario;

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
        if (Auth::user()->id_rol == '4') {
            $campania = Campanias::findOrFail($this->id_campania);
            $archive = DB::table('files_status')->where('id_attach_status_file', $campania->attachStatusFile->id)->get();
            if ($archive->count() > 0) {
                $campania->status = 'Confirmado';
                $campania->display = '#f3a40c';
                $campania->updated_at = now();
                $campania->save();
                if ($campania) {
                    $attach = AttachStatusFiles::find($campania->attachStatusFile->id);
                    $attach->comment = NULL;
                    $attach->status = 'Confirmado';
                    $attach->updated_at = now();
                    $attach->save();
                    if ($attach) {
                        Mail::to($campania->user->email)->queue(new NotificacionConfirmacion($campania));
                        toast()->success('Se ha confirmado la campaña', 'Campaña confirmado')->push();
                        $this->closeModal();
                    }
                }
            } else {
                toast()->info('No se puede confirmar, ya que el usuario no cargado los archivos')->push();
                $this->closeModal();
            }
        } else {
            toast()->info('No tengo permiso para realizar la acción')->push();
        }
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
        $this->validate(['comentario' => 'required|min:10']);
        $campania = Campanias::findOrFail($this->id_campania);
        if (Auth::user()->id_rol == '4') {
            try {

                $attach = AttachStatusFiles::find($campania->attachStatusFile->id);
                $attach->comment = $this->comentario;
                $attach->status = 'Pendiente';
                $attach->updated_at = now();
                $attach->save();
                if ($attach) {
                    $campania['comment'] = $attach->comment;
                    Mail::to($campania->user->email)->queue(new FilePending($campania));
                    toast()->success('Se ha enviado notificacion al creador de la campaña')->push();
                    $this->closeModal();
                }
            } catch (\Throwable $th) {
                toast()->info('Verique la informacion o comuniquese con el administrador del sistema')->push();
            }
        } else {
            toast()->info('No tengo permiso para realizar la acción')->push();
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