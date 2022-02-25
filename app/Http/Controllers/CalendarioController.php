<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Espacios;
use App\Models\Medios;
use App\Models\UnidadesNegocios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    //
    public function calendario($calendario)
    {
        # code...
        $calendario = $calendario;
        $medios = Medios::all();
        $clientes = Clientes::where('id_user', Auth::id())->get();

        $unidades = UnidadesNegocios::all();
        if ($calendario == 'general') {
            $espacios = Espacios::where('estatus', '=', true)->get();
            return view('pages.calendarios.general', compact('medios', 'clientes', 'espacios', 'unidades'));
        } elseif ($calendario == 'airo') {
            $espacios = Espacios::where([
                ['id_unidad_negocio', '1'],
                ['estatus', true]
            ])->get();
            return view('pages.calendarios.airo', compact('medios', 'clientes', 'espacios', 'unidades'));
        } elseif ($calendario == 'showcenter') {
            $espacios = Espacios::where([
                ['id_unidad_negocio', '4'],
                ['estatus', true]
            ])->get();
            return view('pages.calendarios.showcenter', compact('medios', 'clientes', 'espacios', 'unidades'));
        } elseif ($calendario == 'main') {
            $espacios = Espacios::where([
                ['id_unidad_negocio', '3'],
                ['estatus', true]
            ])->get();
            return view('pages.calendarios.main', compact('medios', 'clientes', 'espacios', 'unidades'));
        } elseif ($calendario == 'fashion') {
            $espacios = Espacios::where([
                ['id_unidad_negocio', '2'],
                ['estatus', true]
            ])->get();
            $espacios = Espacios::where('id_unidad_negocio', '2')->get();
            return view('pages.calendarios.fashion', compact('medios', 'clientes', 'espacios', 'unidades'));
        }
    }

    public function getCampanias()
    {
        $campanias = DB::table('vCampanias')->get();
        return response()->json($campanias);
    }

    public function getCampaniaAiro()
    {
        $espacios = UnidadesNegocios::find(1)->espacios;
        $espacios = $espacios->pluck('id');

        $campanias = DB::table('vCampaniaEspacio')
            ->selectRaw('id_campania as id, title, start, end, display as backgroundColor, status as estado, hold')
            ->whereIn('id_espacio', $espacios)
            ->groupBy('id')
            ->get();
    }


    public function getCampaniaFashion()
    {
        # code...
        $espacios = UnidadesNegocios::find(2)->espacios;
        $espacios = $espacios->pluck('id');

        $campanias = DB::table('vCampaniaEspacio')
            ->selectRaw('id_campania as id, title, start, end, display as backgroundColor, status as estado, hold, users, cliente, medios')
            ->whereIn('id_espacio', $espacios)
            ->groupBy('id')
            ->get();
        return response()->json($campanias);
    }

    public function getCampaniaMain()
    {
        # code...
        $espacios = UnidadesNegocios::find(3)->espacios;
        $espacios = $espacios->pluck('id');

        $campanias = DB::table('vCampaniaEspacio')
            ->selectRaw('id_campania as id, title, start, end, display as backgroundColor, status as estado, hold, users, cliente, medios')
            ->whereIn('id_espacio', $espacios)
            ->groupBy('id')
            ->get();
        return response()->json($campanias);
    }

    public function getCampaniaShowcenter()
    {
        $espacios = UnidadesNegocios::find(4)->espacios;
        $espacios = $espacios->pluck('id');

        $campanias = DB::table('vCampaniaEspacio')
            ->selectRaw('id_campania as id, title, start, end, display as backgroundColor, status as estado, hold, users, cliente, medios')
            ->whereIn('id_espacio', $espacios)
            ->groupBy('id')
            ->get();
        return response()->json($campanias);
    }
}