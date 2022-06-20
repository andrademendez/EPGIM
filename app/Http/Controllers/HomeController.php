<?php

namespace App\Http\Controllers;

use App\Models\Campanias;
use App\Models\Espacios;
use App\Models\UnidadesNegocios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //viewHome

    public function dashboard()
    {
        $this->authorize('viewHome', User::class);


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
        $negocioPorcentual = $this->porcentajePorUnidad();
        //$espacios = Espacios::selectRaw('')->get();
        return view('dashboard', compact('totalVenta', 'totalChart', 'totalPorcentaje', 'unidades', 'ventaUnidad', 'ventaPorUnidad', 'negocioPorcentual'));
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


    function espacioOcupado()
    {
        $totalVendido = Campanias::whereIn('status', ['Confirmado', 'Cerrado'])
            ->where('end', '>', now())
            ->get();

        return $totalVendido;
    }

    private function ventaPorUnidad()
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

    private function porcentajePorUnidad()
    {
        # code...
        $totalVendido = $this->ventaPorUnidad();
        foreach ($totalVendido as $total) {
            # code...
            $totals[] = [(($total->total * 100) / $totalVendido->sum('total'))];
            $unidad[] = ($total->unidad);
        }
        //$totalVendido = $totalVendido->pluck('unidad');
        $t[] = round($totals[0][0], 2);
        $t[] =  round($totals[1][0], 2);
        return ($t);
    }
    public function ciudad()
    {
        $this->authorize('viewAny', User::class);
        return view('pages.ciudad.index');
    }

    public function test()
    {
        # code...
        $valor = false;
        $id = 46;
        $campania = Campanias::find($id);

        foreach ($campania->espacios  as $espacio) {
            if ($espacio->id_tipo_espacio == 13) {
                # code...
                $existen = DB::table('vEspacioConfirmado')

                    ->whereBetween('start', [$campania->start, $campania->end])
                    ->orWhereBetween('end', [$campania->start, $campania->end])
                    ->where('id_espacio', $espacio->id)
                    ->get();

                $total =  count($existen);
                if ($total <= 12) {
                    $valor = true;
                } else {
                    $valor = false;
                    break;
                }
            } else {
                $existen2 = DB::table('vEspacioConfirmado')

                    ->whereBetween('start', [$campania->start, $campania->end])
                    ->orWhereBetween('end', [$campania->start, $campania->end])
                    ->where('id_espacio', $espacio->id)
                    ->get();

                $total2 = count($existen2);
                if ($total2 == 0) {
                    $ima = true;
                } else {
                    $valor = false;
                    break;
                }
            }
        }

        return ($valor);
    }
}