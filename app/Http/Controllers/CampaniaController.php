<?php

namespace App\Http\Controllers;

use App\Models\Campanias;
use App\Models\Clientes;
use App\Models\Espacios;
use App\Models\Medios;
use App\Models\UnidadesNegocios;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DateTime;
use Illuminate\Support\Facades\Date;

class CampaniaController extends Controller
{

    public function index()
    {
        //
        $medios = Medios::all();
        $clientes = Clientes::all();
        $espacios = Espacios::all();
        $unidades = UnidadesNegocios::all();
        return view('pages.campanias.index', compact('medios', 'clientes', 'espacios', 'unidades'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //dd($request);
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
        $existen = $this->getBloqueoFecha($start, $end, $request->espacio);

        if ($existen->count() == 0) {

            $existe = DB::table('campanias')
                ->where([
                    ['title', $request->title],
                    ['start', $start],
                    ['end', $end],
                    ['status', 'Solicitud'],
                ])->exists();

            if ($existe) {
                return response()->json(['info', 'Ya existe un evento similar']);
            } else {
                $campania = new Campanias();
                $campania->title = $request->title;
                $campania->start = $start;
                $campania->end = $end;
                $campania->status = 'Solicitud';
                $campania->hold = '1';
                $campania->display = "#30a3cf";
                $campania->id_user = Auth::id();
                $campania->id_cliente = $request->cliente;
                $campania->id_medio = $request->medio;
                $campania->save();
                if ($campania) {
                    $campania->espacios()->attach($request->espacio);
                    return response()->json(['success', 'Campaña registrado!!']);
                }
            }
        } else {
            foreach ($existen as $existe) {
                # code...
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy(Request $request)
    {
        try {
            $campania = Campanias::find($request->id);
            if (Auth::id() == $campania->id_user) {

                $delespacio = $campania->espacios()->detach();
                if ($delespacio) {
                    $gp = $campania->forceDelete();
                    if ($gp) {
                        return response()->json(['success', 'Campaña eliminado!!']);
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['error', 'Hay dependencias activos de este evento']);
        }
    }
    //agregar espacio en el formulario de editar
    public function agregarEspacio(Request $request)
    {
        //$this->authorize('update', Calendario::class);
        $user = Auth::id();
        $id = $request->id;
        $campania = Campanias::find($id);

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
    //quitar espacio en el formulario de editar
    public function eliminarEspacio(Request $request)
    {
        $user = Auth::id();
        $espacio = $request->espacio;
        $evento = Campanias::findOrFail($request->id);
        try {
            if ($user == $evento->id_user) {
                if ($evento->status == 'Confirmado') {
                    return response()->json(['info', 'Espacios reservados no se pueden eliminar']);
                } else {
                    $delof = $evento->espacios()->detach($espacio);
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

    public function getCampanias()
    {
        $campanias = DB::table('vCampanias')->get();
        return response()->json($campanias);
    }

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

    public function test()
    {
        # code...
        $RET = '';
        $start = "2022-01-01";
        $end = "2022-01-31";

        $espacio = [1, 2];

        $result = DB::table('bloqueos')
            ->whereBetween('fecha', [$start, $end])
            ->orderBy('fecha', 'asc')->get();

        $fechas = $this->bloqueosFecha($start, $end);
        return dd($fechas);
    }

    //ver la cantidad de veces que ha sido bloqueada una fecha
    public function bloqueosFecha($start, $end)
    {
        $result = false;

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
                    $this->result = true;
                }
            } else {
                foreach ($bloqueos as $bloqueo) {
                    if ($bloqueo->fecha == $date) {
                        //

                    } else {
                        $data = DB::table('bloqueos')->insert([
                            'fecha' => $date,
                            'created_at' => now()
                        ]);
                        if ($data) {
                            $this->result = true;
                        }
                    }
                }
            }
        }

        return  $result;
    }

    public function getBloqueoFecha($start, $end, $espacio)
    {

        $result = DB::table('vFechaBloqueo')
            ->selectRaw('count(estatus) as total, estatus')
            ->whereBetween('fecha', [$start, $end])
            ->WhereIn('espacio', $espacio)
            ->groupBy('estatus')->get();




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
            ->select('espacios.id as id', 'id_campania', 'espacios.nombre')
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
            ->select('espacios.id as id', 'id_campania', 'espacios.nombre')
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

    public function updatePosition($start, $end, $espacio)
    {
        $campania = DB::table('vCampaniaEspacio')
            ->where('status', '=', 'Solicitud')
            ->whereBetween('start', [$start, $end])
            ->orWhereBetween('end', [$start, $end])
            //->orWhere('start', $start)
            //->orWhere('end', $end)
            ->whereIn('id_espacio', $espacio)
            ->groupBy('id_campania')
            ->get();

        return $campania;
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

    public function challege($id)
    {
        $campani = DB::table('cama');
    }
}