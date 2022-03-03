<?php

namespace App\Exports;

use App\Models\Campanias;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class CampaniaExport implements FromView
{
    public $status, $medio;

    public function __construct($status, $medio)
    {
        $this->status = $status;
        $this->medio = $medio;
    }


    public function view(): View
    {
        return view('exports.campanias', [
            'invoices' => Campanias::where(
                [
                    ['id_user', '=', Auth::id()],
                    ['id_medio',  'LIKE', "%$this->medio%"],
                    ['status', 'LIKE', "%$this->status%"]
                ]
            )->get()
        ]);
    }
}