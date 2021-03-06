<?php

namespace App\Http\Livewire;

use App\Exports\CampaniaExport;
use App\Http\Controllers\CampaniaController;
use App\Mail\ChallengeNotification;
use App\Mail\NotificarAdministrador;
use App\Models\AttachStatusFiles;
use App\Models\Campanias;
use App\Models\Espacios;
use App\Models\FilesStatus;
use App\Models\Medios;
use App\Models\Operaciones\Actividades;
use App\Models\Operaciones\TiposOrdenes;
use App\Models\Roles;
use App\Models\Ubicacion;
use App\Models\UnidadesNegocios;
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
use Maatwebsite\Excel\Facades\Excel;

class Detalles extends Component
{

    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $search = '', $open, $action, $searchMedio = "", $searchUnidad = "", $searchUbicacion = "", $searchStatus;
    public $documentos, $id_campania, $solicitudes, $attachStatusFile, $attachStatusFile_id, $camp_first, $openForm;

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
        $this->attachStatusFile = $cmp->attachStatusFile;
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
        $this->action = "Orden de Servicio";
    }

    public function openOrden($id)
    {
        # code...
        $this->open = true;
        $this->id_campania = $id;
        $this->action = "Orden de Servicio";
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
                        Mail::to($verificador->email)->queue(new NotificarAdministrador($camp));

                        $idCamp = $this->sendMailChallengue($camp->id);
                        $campanias = Campanias::whereIn('id', $idCamp)->get();
                        foreach ($campanias as $campania) {
                            //$this->showAlert($campania->user->email, 'success');
                            if ($camp->id == $campania->id) {
                                break;
                            }
                            Mail::to($campania->user->email)->queue(new ChallengeNotification($camp));
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
                    Mail::to($verificador->email)->queue(new NotificarAdministrador($camp));

                    $this->attachStatusFile = Campanias::find($this->id_campania)->attachStatusFile;
                }
            }
        }
    }
    public function openAddDocs($id)
    {
        $this->openForm = "AddDocs";
        $this->attachStatusFile_id  = $id;
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
            $attach->id_attach_status_file = $this->attachStatusFile_id;
            $attach->save();
            if ($attach) {
                toast()->success('Archivo cargado!!')->push();
                //$this->showAlert('Archivo cargado!!', 'success');
                $this->reset(['documentos', 'attachStatusFile_id', 'openForm']);
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
        $user = User::find(Auth::id());
        if ($user->isAdmin()) {
            return view('livewire.detalles', [
                'campanias' =>  Campanias::where(
                    [
                        ['title', 'LIKE', "%$this->search%"],
                        ['id_medio',  'LIKE', "%$this->searchMedio%"],
                        ['status', 'LIKE', "%$this->searchStatus%"],
                        // ['espacios.id_unidad_negocio',  'LIKE', "%$this->searchUnidad%"],
                        // ['espacios.id_ubicacion',  'LIKE', "%$this->searchUbicacion%"],
                    ]
                )->where('start', '>=', now())
                    // ->join('campania_espacio', 'campanias.id', '=', 'campania_espacio.id_campania')
                    // ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
                    ->orderBy('start', 'desc')
                    ->paginate(15),

                'user' =>  $user,
                'medios' => Medios::all(),
                'unidades' => UnidadesNegocios::all(),
                'ubicaciones' => Ubicacion::all(),
                'actividades' => Actividades::all(),
                'ordenes' => TiposOrdenes::all(),
            ]);
        } else {
            return view('livewire.campanias.detalles', [
                'campanias' =>  Campanias::where(
                    [
                        ['id_user', '=', Auth::id()],
                        ['title', 'LIKE', "%$this->search%"],
                        ['id_medio',  'LIKE', "%$this->searchMedio%"],
                        ['status', 'LIKE', "%$this->searchStatus%"],
                    ]
                )
                    ->where('start', '>=', now())
                    ->orderBy('start', 'desc')
                    ->paginate(15),
                'user' =>  $user,
                'medios' => Medios::all(),
                'unidades' => UnidadesNegocios::all(),
                'ubicaciones' => Ubicacion::all(),

            ]);
        }
    }

    public function exportExcel()
    {

        return Excel::download(new CampaniaExport($this->searchStatus, $this->searchMedio), 'campa??as.xlsx');
    }

    public function exportPDF()
    {

        // return Excel::download(new CampaniaExport($this->searchStatus, $this->searchMedio), 'campa??as.pdf');
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

    public function resetear()
    {
        # code...
        $this->searchMedio = '';
        $this->searchUbicacion = '';
        $this->searchUnidad = '';
        $this->searchStatus = '';
    }
}