<?php

namespace App\Exports;

use App\Models\Campanias;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class OnlyCampaniaExport implements FromView
{
    public $estatus, $search = "";

    public function __construct($estatus)
    {
        $this->estatus = $estatus;
    }

    public function view(): View
    {
        if ($this->estatus == 'activo') {
            $condicion = [
                ['start', '<', now()],
                ['end', '>', now()]
            ];
            $status = ['Cerrado', 'Confirmado'];
        } elseif ($this->estatus == 'pendiente') {
            $condicion  = [
                ['start', '>', now()]
            ];
            $status = ['Cerrado', 'Confirmado'];
        } elseif ($this->estatus == 'terminado') {
            $condicion  = [['end', '<', now()]];
            $status = ['Cerrado', 'Confirmado'];
        } else {
            $condicion  = [['title', 'LIKE', "%$this->search%"]];
            $status = ['Solicitud', 'Challenge', 'Confirmado', 'Cerrado'];
        }

        return view('exports.allCampania', [
            'invoices' => DB::table('campania_espacio')
                ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
                ->join('clientes', 'clientes.id', '=', 'campanias.id_cliente')
                ->join('medios', 'medios.id', '=', 'campanias.id_medio')
                ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
                ->join('unidades_negocios', 'unidades_negocios.id', '=', 'espacios.id_unidad_negocio')
                ->join('tipos_espacios', 'tipos_espacios.id', '=', 'espacios.id_tipo_espacio')
                ->join('ubicaciones_espacios', 'ubicaciones_espacios.id', '=', 'espacios.id_ubicacion')
                ->selectRaw("campanias.*, medios.nombre as medio, clientes.contacto as contacto, clientes.nombre as cliente, espacios.*, unidades_negocios.nombre as unidad, tipos_espacios.nombre as tipo, ubicaciones_espacios.nombre as ubicacion")
                ->get(),
        ]);
    }
}