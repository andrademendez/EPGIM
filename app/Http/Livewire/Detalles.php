<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CampaniaController;
use App\Mail\NotificarAdministrador;
use App\Models\AttachStatusFiles;
use App\Models\Campanias;
use App\Models\FilesStatus;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Facades\Mail;

class Detalles extends Component
{

    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $search = '', $open, $action;
    public $documentos, $id_campania, $solicitudes, $attachStatusFile, $camp_first;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function openModal($id)
    {
        $this->open = true;
        $this->action = 'Registrar';
        $this->id_campania = $id;
        $this->attachStatusFile = Campanias::find($id)->attachStatusFile;
        $this->camp_first = $this->getFirstCampania($id);
    }

    public function openEdit()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
        $this->reset(['documentos', 'id_campania', 'attachStatusFile']);
    }

    public function openDelete()
    {
        $this->open = true;
    }

    public function sendChallenge()
    {
        $camp = Campanias::find($this->id_campania);
        $espacio = DB::table('vEspacio')->where('campania', $this->id_campania)->get();
        $confirmado = CampaniaController::getConfirmado($camp->start, $camp->end, $espacio->pluck('espacio'));
        $solicitud = CampaniaController::getSolicitud($camp->start, $camp->end, $espacio->pluck('espacio'));
        if ($confirmado->max('total') <= 12 && $solicitud->max('total') <= 12) {
            $camp->status = 'Challenge';
            $camp->display = '#fbb904';
            $camp->save();
            if ($camp) {
                $challenge = new AttachStatusFiles();
                $challenge->process = $camp->status;
                $challenge->status = 'Send';
                $challenge->id_campania = $camp->id;
                $challenge->save();
                if ($challenge) {
                    toast()->success('Porfavor cargue los archivos correspondientes para continuar con el proceso...')->push();
                    //$this->showAlert('Porfavor cargue los archivos correspondientes.', 'success');
                    $this->campania = Campanias::find($this->id_campania);
                    $verificador = User::where('id_rol', 4)->first();
                    Mail::to($verificador->email)->send(new NotificarAdministrador($camp));
                    $this->attachStatusFile = Campanias::find($this->id_campania)->attachStatusFile;
                }
            }
        }
    }

    public function sendConfirmation()
    {
        //challenge->status = ['Send', 'Pendiente', 'Confirmado', 'Cerrado']
        $camp = Campanias::find($this->id_campania);
        $espacio = DB::table('vEspacio')->where('campania', $this->id_campania)->get();
        $confirmado = CampaniaController::getConfirmado($camp->start, $camp->end, $espacio->pluck('espacio'));
        $solicitud = CampaniaController::getSolicitud($camp->start, $camp->end, $espacio->pluck('espacio'));
        if ($confirmado->max('total') <= 12 && $solicitud->max('total') <= 12) {
            $camp->status = 'Solicitud';
            $camp->display = '#eb9a14';
            $camp->save();
            if ($camp) {
                $challenge = new AttachStatusFiles();
                $challenge->process = 'Confirmacion';
                $challenge->status = 'Send';
                $challenge->id_campania = $camp->id;
                $challenge->save();
                if ($challenge) {
                    toast()->success('Porfavor cargue los archivos correspondientes para continuar con el proceso...')->push();
                    //$this->showAlert('Porfavor cargue los archivos correspondientes.', 'success');
                    $this->campania = Campanias::find($this->id_campania);
                    $verificador = User::where('id_rol', 4)->first();
                    Mail::to($verificador->email)->send(new NotificarAdministrador($camp));

                    $this->attachStatusFile = Campanias::find($this->id_campania)->attachStatusFile;
                }
            }
        }
    }
    public function attachFiles()
    {
        # code...
        $this->validate([
            'documentos' => 'required'
        ]);
        try {
            $url = $this->documentos->store('challenge', 'public');
            $url = Storage::url($url);

            $attach = new FilesStatus();
            $attach->file = $url;
            $attach->id_attach_status_file = $this->attachStatusFile->id;
            $attach->save();
            if ($attach) {
                toast()->success('Archivo cargado!!')->push();
                //$this->showAlert('Archivo cargado!!', 'success');
                $this->reset('documentos');
                $this->attachStatusFile = Campanias::find($this->id_campania)->attachStatusFile;
            }
        } catch (\Throwable $th) {
            $this->showAlert('Error al cargar el archivo', 'error');
        }
    }

    public function getFirstCampania($id)
    {
        # code...
        $camp = Campanias::find($id);
        $espacio = DB::table('vEspacio')->where('campania', $id)->get();
        $espacios = $espacio->pluck('espacio');

        $date_start = new DateTime($camp->start);
        $date_start = $date_start->format('Y-m-d');
        $date_end = new DateTime($camp->end);
        $date_end = $date_end->format('Y-m-d');

        $position = DB::table('vFechaBloqueov2')
            ->whereIn('estatus', ['Challenge', 'Solicitud'])
            ->whereBetween('fecha', [$date_start, $date_end])
            ->whereIn('id_pantalla', $espacios)
            ->groupBy('id_campania')
            ->first();

        return $position->id_campania;
    }

    public function render()
    {
        return view('livewire.detalles', [
            'campanias' => Campanias::where(
                [
                    ['id_user', '=', Auth::id()],
                    ['title', 'LIKE', "%$this->search%"]
                ]
            )->orderBy('start', 'asc')
                ->paginate(15)
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