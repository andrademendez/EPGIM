<?php

namespace App\Http\Controllers;

use App\Models\Espacios;
use App\Models\UnidadesNegocios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function dashboard()
    {
        $totalVentaDigital = Espacios::selectRaw('sum(precio) as total')->where([
            ['id_tipo_espacio', '=', 13],
            ['estatus', true]
        ])->first();
        $totalVentaIn = Espacios::selectRaw('sum(precio) as total')->where([
            ['id_tipo_espacio', '!=', 13],
            ['estatus', true]
        ])->first();
        $totalVenta = ($totalVentaDigital->total * 12) + $totalVentaIn->total;
        $totalVendido = DB::table('campania_espacio')
            ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
            ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
            ->selectRaw('sum(precio) as total')
            ->whereIn('status', ['Confirmado', 'Cerrado'])->first();

        $totalChart = [$totalVendido->total, ($totalVenta) - $totalVendido->total];
        $totalPorcentaje = [round(($totalVendido->total * 100) / $totalVenta, 2), round((($totalVenta - $totalVendido->total) * 100) / $totalVenta, 2)];
        //
        $unidades = UnidadesNegocios::all();

        $ventaUnidad = $this->unidadVenta();
        $ventaPorUnidad = $this->ventaPorUnidad();
        return view('dashboard', compact('totalVenta', 'totalChart', 'totalPorcentaje', 'unidades', 'ventaUnidad', 'ventaPorUnidad'));
    }

    public function unidadVenta()
    {
        $totales = [];
        $unidadesDig = Espacios::selectRaw('sum(precio) as total, id_unidad_negocio as unidad')
            ->where([
                ['estatus', true],
                ['id_tipo_espacio', '=', 13],
            ])
            ->groupBy('id_unidad_negocio')->get();

        $unidadesDig = $unidadesDig->pluck('total', 'unidad');
        $unidadesGen = Espacios::selectRaw('sum(precio) as total, id_unidad_negocio as unidad')
            ->where([
                ['estatus', true],
                ['id_tipo_espacio', '!=', 13],
            ])
            ->groupBy('id_unidad_negocio')->get();

        $unidadesGen = $unidadesGen->pluck('total', 'unidad');
        //id_tipo_espacio
        $varl = (isset($unidadesDig[1]) * 12) + isset($unidadesGen[1]);
        $varl2 = ($unidadesDig[2] * 12) + $unidadesGen[2];
        $varl3 = ($unidadesDig[3] * 12) + $unidadesGen[3];
        $varl4 = ($unidadesDig[4] * 12) + isset($unidadesGen[4]);
        $totales['Airó'] = $varl;
        $totales['Fashion Drive'] =  $varl2;
        $totales['Main Entrance'] = $varl3;
        $totales['Showcenter'] = $varl4;
        return ($totales);
    }

    public function ventaPorUnidad()
    {
        # code...
        $totalVendido = DB::table('campania_espacio')
            ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
            ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
            ->join('unidades_negocios', 'unidades_negocios.id', '=', 'espacios.id_unidad_negocio')
            ->selectRaw('sum(precio) as total, unidades_negocios.nombre as unidad')
            ->whereIn('status', ['Confirmado', 'Cerrado'])
            ->groupBy('unidad')
            ->get();
        return $totalVendido;
    }

    public function ciudad()
    {
        $this->authorize('viewAny', User::class);
        return view('pages.ciudad.index');
    }
}