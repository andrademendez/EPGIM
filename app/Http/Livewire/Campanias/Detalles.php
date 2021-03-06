<?php

namespace App\Http\Livewire\Campanias;

use App\Http\Controllers\CampaniaController;
use App\Mail\ChallengeNotification;
use App\Mail\NotificarAdministrador;
use App\Models\AttachStatusFiles;
use App\Models\Campanias;
use App\Models\FilesStatus;
use App\Models\Medios;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class Detalles extends Component
{

    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $search = '', $open, $action, $searchMedio = "", $searchUnidad = "", $searchUbicacion = "", $searchStatus;
    public $documentos, $id_campania, $solicitudes, $attachStatusFile, $camp_first;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function openModal($id)
    {
        $this->open = true;
        $this->action = 'Registrar';
        $this->id_campania = $id;
        $cmp = Campanias::find($id);
        if ($cmp->status == 'Confirmado') {
            $this->camp_first = $cmp->id;
        } else {
            $this->camp_first = $this->getFirstCampania($id);
        }
        $this->attachStatusFile = Campanias::find($id)->attachStatusFile;
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
        if ($confirmado->max('total') <= 12) {
            if ($solicitud->max('total') <= 12) {
                $camp->status = 'Challenge';
                $camp->display = '#feff00';
                $camp->save();
                if ($camp) {
                    $challenge = new AttachStatusFiles();
                    $challenge->process = $camp->status;
                    $challenge->status = 'Send';
                    $challenge->id_campania = $camp->id;
                    $challenge->save();
                    if ($challenge) {


                        //$this->showAlert('Porfavor cargue los archivos correspondientes.', 'success');
                        $this->campania = Campanias::find($this->id_campania);
                        $verificador = User::where('id_rol', 4)->first();
                        Mail::to($verificador->email)->send(new NotificarAdministrador($camp));

                        $idCamp = $this->sendMailChallengue($camp->id);
                        $campanias = Campanias::whereIn('id', $idCamp)->get();
                        foreach ($campanias as $campania) {
                            //$this->showAlert($campania->user->email, 'success');
                            if ($camp->id == $campania->id) {
                                break;
                            }
                            Mail::to($campania->user->email)->send(new ChallengeNotification($camp));
                        }
                        toast()->success('Porfavor cargue los archivos correspondientes para continuar con el proceso...')->push();
                        $this->attachStatusFile = Campanias::find($this->id_campania)->attachStatusFile;
                    }
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
        // $this->showAlert($this->attachStatusFile->id, 'error');
        // return false;
        try {
            $url = $this->documentos->store('challenge', 'public');
            $url = Storage::url($url);

            $attach = new FilesStatus();
            $attach->file = $url;
            foreach ($this->attachStatusFile as $key => $atach) {
                # code...
                if ($atach->process == 'Confirmacion') {
                    $attach->id_attach_status_file = $atach->id;
                }
            }
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
            ->select('id_campania', 'nombre')
            ->groupBy('id_campania', 'nombre')
            ->first();

        return $position->id_campania;
    }

    public function sendMailChallengue($id)
    {
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
            ->get();

        return $position->pluck('id_campania');
    }

    public function render()
    {
        return view('livewire.campanias.detalles', [
            'campanias' =>  Campanias::where(
                [
                    ['id_user', '=', Auth::id()],
                    ['title', 'LIKE', "%$this->search%"],
                    ['id_medio',  'LIKE', "%$this->searchMedio%"],
                    ['status', 'LIKE', "%$this->searchStatus%"],
                ]

            )->where('start', '>=', now())
                ->orderBy('start', 'desc')
                ->paginate(15),
            'user' =>  User::find(Auth::id()),
            'medios' => Medios::all(),
            'unidades' => UnidadesNegocios::all(),
            'ubicaciones' => Ubicacion::all(),

        ]);
    }
}