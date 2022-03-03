<?php

namespace App\Exports;

use App\Models\Espacios;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EspaciosExport implements FromView
{
    public $unidad, $tipo, $ubicacion;

    public function __construct($unidad, $tipo, $ubicacion)
    {
        $this->unidad = $unidad;
        $this->tipo = $tipo;
        $this->ubicacion = $ubicacion;
    }

    public function view(): View
    {
        return view('exports.espacios', [
            'espacios' => Espacios::where(
                [
                    ['id_unidad_negocio', 'LIKE', "%$this->unidad%"],
                    ['id_tipo_espacio', 'LIKE', "%$this->tipo%"],
                    ['id_ubicacion', 'LIKE', "%$this->ubicacion%"]
                ]
            )->get()
        ]);
    }
    public function collection()
    {
        return Espacios::all();
    }
}