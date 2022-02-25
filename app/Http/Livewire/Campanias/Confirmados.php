<?php

namespace App\Http\Livewire\Campanias;

use App\Models\AttachStatusFiles;
use App\Models\Campanias;
use App\Models\FilesStatus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

use function PHPUnit\Framework\isNull;

class Confirmados extends Component
{
    use WithFileUploads;
    use WithPagination, WireToast;
    public $search, $open, $action, $fotos, $archivos, $archivoT, $id_campania, $id_attach;

    public function openModal($id)
    {
        # code...
        $this->open = true;
        $attach = AttachStatusFiles::find($id);
        $archivos = $attach->filesStatus;
        $this->id_campania = $attach->id_campania;
        $this->id_attach = $attach->id;
        $this->archivoT = $archivos->count();
        $this->archivos = $archivos;
    }

    public function closeModal()
    {
        $this->open = false;
        $this->reset(['fotos', 'id_campania', 'archivoT', 'archivos']);
    }

    public function attachFotos()
    {
        # code...
        $this->validate([
            'fotos' => 'required'
        ]);
        try {
            $url = $this->fotos->store('cierres', 'public');
            $url = Storage::url($url);

            $attach = new FilesStatus();
            $attach->file = $url;
            $attach->id_attach_status_file = $this->id_attach;
            $attach->save();
            if ($attach) {
                toast()->success('Archivo cargado!!')->push();
                //$this->showAlert('Archivo cargado!!', 'success');
                $this->reset('fotos');
                $attach = AttachStatusFiles::find($this->id_attach);
                $this->archivos = $attach->filesStatus;
            }
        } catch (\Throwable $th) {
            toast()->danger('Error al cargar archivo!!')->push();
        }
    }

    public function cerrarCampania()
    {
        # code...
        try {
            $attach = AttachStatusFiles::find($this->id_attach);
            $attach->status = 'Confirmado';
            $attach->save();
            if ($attach) {
                $campania = Campanias::find($attach->id_campania);
                $campania->status = 'Cerrado';
                $campania->display = '#2eb74a';
                $campania->created_at = now();
                $campania->save();
                if ($campania) {
                    toast()->success('Evento cerrado!!')->push();
                    $this->closeModal();
                }
            }
        } catch (\Throwable $th) {
            toast()->info('Problema al cerrar!!')->push();
        }
    }
    public function registrarCierre($id)
    {
        # code...
        $camp = AttachStatusFiles::where([
            ['id_campania',  $this->id_campania],
            ['process', 'Cierre']
        ])->first();

        if (empty($camp)) {
            $attach = new AttachStatusFiles();
            $attach->process = 'Cierre';
            $attach->status = 'Send';
            $attach->id_campania = $id;
            $attach->save();
            if ($attach) {
                # code...
                toast()->info('Cargue los archivos corresondiente para continuar', 'Proceso iniciado')->push();
            }
        }
    }
    public function render()
    {
        return view('livewire.campanias.confirmados', [
            'campanias' => Campanias::where(
                [
                    ['title', 'LIKE', "%$this->search%"],
                    ['status', '=', 'Confirmado']
                ]
            )->orderBy('start', 'asc')
                ->paginate(15),
        ]);
    }
}