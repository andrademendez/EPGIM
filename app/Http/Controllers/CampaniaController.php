<?php

namespace App\Http\Controllers;

use App\Mail\NotificarAdministrador;
use App\Models\AttachStatusFiles;
use App\Models\Bloqueos;
use App\Models\Campanias;
use App\Models\Clientes;
use App\Models\Espacios;
use App\Models\FilesStatus;
use App\Models\Medios;
use App\Models\UnidadesNegocios;
use App\Models\User;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Mime\Email;

class CampaniaController extends Controller
{

    public function index()
    {
        //
        $this->authorize('viewAny', Campanias::class);
        $calendario = "";
        $medios = Medios::all();
        $clientes = Clientes::where('id_user', Auth::id())->get();
        $espacios = Espacios::all();
        $unidades = UnidadesNegocios::all();
        if ($calendario) {
            # code...
        }
        return view('pages.campanias.index', compact('medios', 'clientes', 'espacios', 'unidades'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->authorize('create', Campanias::class);
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'start' => 'required',
            'end' => 'required',
            'medio' => 'required',
            'cliente' => 'required',
            'espacio' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['info', $validator->messages()->all()[0]]);
            //return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $start = new DateTime($request->start . ' 00:00:00');
        $start = $start->format('Y-m-d H:i:s');
        $end = new DateTime($request->end . ' 23:59:59');
        $end = $end->format('Y-m-d H:i:s');
        //$espacio = array($request->espacio);

        $existe = DB::table('campanias')
            ->where([
                ['title', $request->title],
                ['start', $start],
                ['end', $end],
            ])->exists();
        if ($existe) {
            return response()->json(['info', 'Ya existe un evento similar']);
        } else {
            $existen = $this->getSolicitud($start, $end, $request->espacio);
            if ($existen->count() == 0) {

                $campania = new Campanias();
                $campania->title = $request->title;
                $campania->start = $start;
                $campania->end = $end;
                $campania->status = 'Solicitud';
                $campania->hold = 1;
                $campania->display = "#13bfec";
                $campania->id_user = Auth::id();
                $campania->id_cliente = $request->cliente;
                $campania->id_medio = $request->medio;
                $campania->save();
                if ($campania) {
                    $campania->espacios()->attach($request->espacio);

                    $fbloqueos = $this->bloqueosFecha($campania->start, $campania->end);
                    $campania->bloqueos()->attach($fbloqueos);
                    return response()->json(['success', 'Campaña registrado!!']);
                }
            } else {

                $confirmados = $this->getConfirmado($request->start, $request->end, $request->espacio);
                if ($confirmados->count() == 0) {

                    $estatus = $this->getSolicitud($request->start, $request->end, $request->espacio);
                    $hold = $estatus->max('total');

                    if ($estatus->max('total') <= 12) {
                        $campania = new Campanias();
                        $campania->title = $request->title;
                        $campania->start = $start;
                        $campania->end = $end;
                        $campania->status = 'Solicitud';
                        $campania->hold = $hold + 1;
                        $campania->display = "#13bfec";
                        $campania->id_user = Auth::id();
                        $campania->id_cliente = $request->cliente;
                        $campania->id_medio = $request->medio;
                        $campania->save();
                        if ($campania) {
                            $campania->espacios()->attach($request->espacio);

                            $fbloqueos = $this->bloqueosFecha($campania->start, $campania->end);
                            $campania->bloqueos()->attach($fbloqueos);
                            return response()->json(['success', 'Campaña registrado!!']);
                        }
                    } else {
                        return response()->json(['info', 'Maximo de hold registrado alcanzado!!']);
                    }
                } else {
                    if ($confirmados->max('total') <= 12) {
                        $estatus = $this->getSolicitud($request->start, $request->end, $request->espacio);
                        $hold = $estatus->max('total');

                        if ($estatus->max('total') < 12) {
                            $campania = new Campanias();
                            $campania->title = $request->title;
                            $campania->start = $start;
                            $campania->end = $end;
                            $campania->status = 'Solicitud';
                            $campania->hold = $hold + 1;
                            $campania->display = "#13bfec";
                            $campania->id_user = Auth::id();
                            $campania->id_cliente = $request->cliente;
                            $campania->id_medio = $request->medio;
                            $campania->save();
                            if ($campania) {
                                $campania->espacios()->attach($request->espacio);

                                $fbloqueos = $this->bloqueosFecha($campania->start, $campania->end);
                                $campania->bloqueos()->attach($fbloqueos);
                                return response()->json(['success', 'Campaña registrado!!']);
                            }
                        } else {
                            return response()->json(['info', 'Maximo de hold registrado alcanzado!!']);
                        }
                    }
                }
            }
        }
    }

    public function show()
    {
        $this->authorize('view', Campanias::class);
        $user = User::find(Auth::id());
        return view('pages.challenge', compact('user'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'start' => 'required',
            'end' => 'required',
            'medio' => 'required',
            'cliente' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['info', $validator->messages()->all()[0]]);
            //return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $start = new DateTime($request->start);
        $start = $start->format('Y-m-d H:i:s');
        $end = new DateTime($request->end);
        $end = $end->format('Y-m-d H:i:s');
        $campania = Campanias::find($request->id);
        if ($campania->id_user == Auth::id()) {
            try {

                $campania->title = $request->title;
                $campania->start = $start;
                $campania->end = $end;
                $campania->id_medio = $request->medio;
                $campania->id_cliente = $request->cliente;
                $campania->save();
                if ($campania) {
                    return response()->json(['success', 'Datos actualizados!!']);
                }
            } catch (\Throwable $th) {
                return response()->json(['error', 'No se han podido actualizar los datos']);
            }
        } else {
            return response()->json(['info', 'No tienes permiso para editar esta campaña!']);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $campania = Campanias::find($request->id);
            if (Auth::id() == $campania->id_user) {

                $delespacio = $campania->espacios()->detach();

                if ($delespacio) {
                    $delcam = $campania->bloqueos()->detach();
                    $gp = $campania->forceDelete();
                    if ($gp) {
                        return response()->json(['success', 'Campaña eliminado!!']);
                    }
                }
            } else {
                return response()->json(['info', 'No tienes permiso para eliminar!!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['error', 'Hay dependencias activos de este evento']);
        }
    }

    public function ordenesServicio($id)
    {
        # code...
        $this->authorize('viewAny', Campanias::class);
        $campania = $id;
        return view('pages.campanias.detalles.ordenes', compact('campania'));
    }

    public function cotizacion($id)
    {
        # code...
        $this->authorize('viewAny', Campanias::class);
        $campania = Campanias::find($id);
        return view('pages.campanias.detalles.cotizacion', compact('campania'));
    }

    public function detalles()
    {
        # code...
        $this->authorize('viewAny', Campanias::class);
        $user = User::find(Auth::id());

        return view('pages.campanias.detalles', compact('user'));
    }

    public function detallesCampanias($id)
    {
        # code...
        $this->authorize('viewAny', Campanias::class);
        $campania = Campanias::find($id);
        return view('pages.campanias.detalles.detalles', compact('campania'));
    }

    //agregar espacio en el formulario de editar
    public function agregarEspacio(Request $request)
    {
        //$this->authorize('update', Calendario::class);
        $validator = Validator::make($request->all(), [
            'espacios' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['info', 'El campo espacio es requerido!']);
            //return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $user = Auth::id();
        $id = $request->id;
        $campania = Campanias::find($id);
        if ($campania->status == 'Confirmado' || $campania->status == 'Cerrado') {
            return response()->json(['info', 'Ya no puedes agregar espacio una ves confirmado']);
        } else {
            if ($user == $campania->id_user) {
                $existen = $this->validarEspacio($campania->start, $campania->end, $request->espacios);
                if ($existen <= 12) {
                    $campania->espacios()->syncWithoutDetaching($request->espacios);
                    $espacio = $this->getConsultaEspacio($id);
                    return response()->json($espacio);
                } else {
                    return response()->json(['info', 'El espacio esta reservado']);
                }
            } else {
                return response()->json(['info', 'No tienes los permisos necesarios']);
            }
        }
    }
    //quitar espacio en el formulario de editar
    public function eliminarEspacio(Request $request)
    {
        $user = Auth::id();
        $espacio = $request->espacio;
        $campania = Campanias::findOrFail($request->id);
        try {
            if ($user == $campania->id_user) {
                if ($campania->status == 'Confirmado' || $campania->status == 'Cerrado') {
                    return response()->json(['info', 'Espacios reservados no se pueden eliminar']);
                } else {
                    $delof = $campania->espacios()->detach($espacio);
                    if ($delof) {
                        $espacios = $this->getConsultaEspacio($request->id);
                        return response()->json($espacios);
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['error', 'Se ha presentado un error']);
        }
    }

    //funcion para obtener todo los eventos getData


    public function getOptions(Request $request)
    {
        $events = DB::table('campanias')
            ->join('medios', 'medios.id', '=', 'campanias.id_medio')
            ->join('clientes', 'clientes.id', '=', 'campanias.id_cliente')
            ->select(
                'campanias.status as estatus',
                'medios.nombre as nombre_medio',
                'medios.id as id_medio',
                'clientes.id as id_cliente',
                'clientes.nombre as nombre_cliente'
            )
            ->where('campanias.id', '=', $request->id)
            ->get()
            ->toArray();
        return response()->json($events);
    }

    //ver la cantidad de veces que ha sido bloqueada una fecha
    public function bloqueosFecha($start, $end)
    {
        $result = 'Iniciando...';

        $date_start = new DateTime($start);
        $date_end = new DateTime($end);
        $date_end = $date_end->modify('+1 day');

        //$intervalo = new DateInterval('P1D');
        $intervalo = DateInterval::createFromDateString('1 days');
        $periodo = new DatePeriod($date_start, $intervalo, $date_end);

        foreach ($periodo as $dt) {

            $date = $dt->format("Y-m-d");
            $bloqueos = DB::table('bloqueos')->where('fecha', $dt)->get();

            if ($bloqueos->count() == 0) {
                $data =  DB::table('bloqueos')->insert([
                    'fecha' => $date,
                    'created_at' => now()
                ]);
                if ($data) {
                    $result = 'Insertado!!';
                }
            } else {
                foreach ($bloqueos as $bloqueo) {
                    if ($bloqueo->fecha == $date) {
                        //
                        $result = 'Datos sin cambios';
                    } else {
                        $data = DB::table('bloqueos')->insert([
                            'fecha' => $date,
                            'created_at' => now()
                        ]);
                        if ($data) {
                            $result = 'Insertados datos pendientes!!';
                        }
                    }
                }
            }
        }
        $date_end = new DateTime($end);
        $datos = DB::table('bloqueos')
            ->whereBetween('fecha', [$date_start, $date_end])->pluck('id');
        return $datos;
    }

    public static function getSolicitud($start, $end, $espacio)
    {
        $date_start = new DateTime($start);
        $date_start = $date_start->format('Y-m-d');

        $date_end = new DateTime($end);
        $date_end = $date_end->format('Y-m-d');

        $result = DB::table('vFechaBloqueov2')
            ->selectRaw('count(estatus) as total, estatus, fecha')
            ->whereBetween('fecha', [$date_start, $date_end])
            ->whereIn('id_pantalla', $espacio)
            ->whereIn('estatus', ['Solicitud', 'Challenge'])
            ->groupBy('fecha', 'pantalla')->get();

        return $result;
    }

    public static function getConfirmado($start, $end, $espacio)
    {
        $date_start = new DateTime($start);
        $date_start = $date_start->format('Y-m-d');

        $date_end = new DateTime($end);
        $date_end = $date_end->format('Y-m-d');

        $result = DB::table('vFechaBloqueov2')
            ->selectRaw('count(estatus) as total,estatus, fecha')
            ->whereBetween('fecha', [$date_start, $date_end])
            ->whereIn('id_pantalla', $espacio)
            ->where('estatus', 'Confirmado')
            ->orWhere('estatus', 'Cerrado')
            ->groupBy('fecha', 'pantalla')->get();

        return $result;
    }


    //funciones para validar la asigancion de eventos a registrar
    //validacion de los espacios, si no está ocupados
    function validarEspacio($start, $end, $espacio)
    {
        $existen = DB::table('vEspacioConfirmado')
            ->where('start', $start)
            ->whereBetween('start', [$start, $end])
            ->orWhereBetween('end', [$start, $end])
            ->whereIn('id_espacio', $espacio)
            ->get();
        return count($existen);
    }

    //consulta de los espacios por evento
    function getConsultaEspacio($id)
    {
        $espacio = DB::table('campania_espacio')
            ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
            ->select('espacios.id as id', 'id_campania', 'espacios.nombre', 'espacios.referencia')
            ->where('id_campania', '=', $id)
            ->get();
        return $espacio;
    }

    //obtener id de los espacios por evento
    function obtenerEspacio($id)
    {
        $espacios = DB::table('campania_espacio')
            ->select('id_espacio as id')
            ->where('id_campania', $id)->get();
        return $espacios;
    }

    public function get_espacio(Request $request)
    {
        $id = $request->id;
        $espacio = $this->getEspacioCam($id);

        return response()->json($espacio);
    }

    //consulta de los espacios por evento
    function getEspacioCam($id)
    {
        $espacio = DB::table('campania_espacio')
            ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
            ->select('espacios.id as id', 'id_campania', 'espacios.nombre', 'espacios.referencia')
            ->where('id_campania', '=', $id)
            ->get();
        return $espacio;
    }

    //asignar holds
    function countPosicionHold($start, $end, $espacio)
    {
        $count = DB::table('vCampaniaEspacio')
            ->where('status', '=', 'Solicitud')
            ->whereBetween('start', [$start, $end])
            ->orWhereBetween('end', [$start, $end])
            // ->orWhere('end', $end)
            ->whereIn('id_espacio', $espacio)
            ->groupBy('id_campania')
            ->get();
        //dump($count);
        return count($count);
    }

    //obtener el primer elemento para poder confirmar
    public static function getFirstCampania(Request $request)
    {
        # code...
        $camp = Campanias::find($request->id);
        $espacio = DB::table('vEspacio')->where('campania', $request->id)->get();
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

        return response()->json($position);
    }

    public function conteoEvento($start, $end)
    {

        $conteo = Campanias::where([
            ['status', 'Solicitud'],
            ['start', $start],
            ['end', $end]
        ])->count();

        return $conteo;
    }

    public function test()
    {
        $camp = Campanias::findOrFail(13);

        $requestId = 'gcruz@grupogim.com.mx';
        $val  = Mail::to($requestId)
            ->send(new NotificarAdministrador($camp));

        return $val;
    }

    function getConfirmado2($start, $end, $espacio)
    {
        $date_start = new DateTime($start);
        $date_start = $date_start->format('Y-m-d');

        $date_end = new DateTime($end);
        $date_end = $date_end->format('Y-m-d');

        $result = DB::table('vFechaBloqueov2')
            ->selectRaw('count(estatus) as total, estatus, fecha')
            ->whereBetween('fecha', [$date_start, $date_end])
            ->where('id_pantalla', $espacio)
            ->whereIn('estatus', ['Confirmado', 'Cerrado'])
            ->groupBy('fecha', 'pantalla')->get();
        $total = $result->max('total');
        return $total;
    }
    public function challege($id)
    {

        $camp = Campanias::find($id);

        $date_start = new DateTime($camp->start);
        $date_start = $date_start->format('Y-m-d');
        $date_end = new DateTime($camp->end);
        $date_end = $date_end->format('Y-m-d');

        $camps = DB::table('vFechaBloqueo')->whereBetween('fecha', [$date_start, $date_end])
            ->groupBy('id_campania')->get();

        $camp = Campanias::whereIn('id', $camps);
        dd($camps->pluck('id_campania'));
    }
}