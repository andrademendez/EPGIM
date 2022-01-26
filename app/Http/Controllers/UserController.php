<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewAny', User::class);
        return view('pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->authorize('update', User::class);

        $usuario = User::find($id);
        $espacios = DB::table('campania_espacio')
            ->join('espacios', 'espacios.id', '=', 'campania_espacio.id_espacio')
            ->join('campanias', 'campanias.id', '=', 'campania_espacio.id_campania')
            ->selectRaw('espacios.id as id, espacios.nombre as nombre, count(espacios.id) as total')
            ->where('campanias.id_user', $id)
            ->groupBy('espacios.nombre', 'espacios.id')
            ->orderBy('id', 'asc')
            ->get();
        $espacioName = $espacios->pluck('nombre');
        $espacioTotal = $espacios->pluck('total');

        return view('pages.users.edit', compact('usuario', 'espacios', 'espacioName', 'espacioTotal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}