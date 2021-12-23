<?php

namespace App\Http\Controllers;

use App\Models\Campanias;
use App\Models\Clientes;
use App\Models\Espacios;
use App\Models\Medios;
use App\Models\UnidadesNegocios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DateTime;

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

        $existe   = $this->validarEspacio($start, $end, $request->espacio);
        //dump($end);
        if ($existe > 0) {
            return response()->json(['info', 'Se ha detactado espacio o espacios ocupados']);
        } else {

            try {
                //conteo de posicion
                $counts = $this->countPosicionHold($start, $end, $request->espacio);

                if ($counts == 0) {
                    $counts = ++$counts;
                } else {
                    $counts = ++$counts;
                }

                //conteo maximo de ventos por dia
                $conteo = $this->conteoEvento($start, $end);

                if ($conteo < 12) {
                    # code...
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
                        $campania->hold = $counts;
                        $campania->display = '#75F6DC';
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
                    return response()->json(['info', 'Se ha excedido el número maximo de hold permitido']);
                }
            } catch (\Throwable $th) {
                //throw $th;
                return dd($th);
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
        //dd($request->id);
        try {
            $destroy = Campanias::find($request->id);

            return response()->json(['info', $destroy]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error', 'NO hay infomacion que mostrar']);
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

    //funciones para validar la asigancion de eventos a registrar
    //validacion de los espacios, si no está ocupados
    function validarEspacio($start, $end, $espacio)
    {
        $existen = DB::table('vEspacioConfirmado')
            ->select('id_espacio')
            ->where('start', '=', $start)
            ->Where('end', '=',  $end)
            ->whereIn('id_espacio', [$espacio])
            ->get();

        return count($existen);
    }
    //consulta de los espacios por evento
    function getConsultaEspacio($id)
    {
        $espacio = DB::table('campania_espacio')
            ->join('espacios', 'espacios.id', '=', 'espacio_evento.espacio_id')
            ->select('espacios.id as id', 'evento_id', 'nombre')
            ->where('evento_id', '=', $id)
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
            ->where([
                ['status', 'Solicitud'],
                ['start', $start],
                ['end', $end]
            ])
            ->whereIn('id_espacio', [$espacio])
            ->groupBy('id_campania')
            ->get();

        return count($count);
    }

    public function updatePosition($start, $end, $espacio)
    {
        $position = $this->countPosicionHold($start, $end, $espacio);
        if ($position == 1) {
        } elseif ($position == 2) {
            $evento = Campanias::where([['start', $start], ['end', $end]])->get();
        }
    }

    public function conteoEvento($start, $end)
    {
        $conteo = Campanias::where([
            ['status', 'Hold'],
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