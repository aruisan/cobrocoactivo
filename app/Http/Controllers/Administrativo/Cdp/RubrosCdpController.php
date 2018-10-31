<?php

namespace App\Http\Controllers\Administrativo\Cdp;

use App\Model\Administrativo\Cdp\RubrosCdp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RubrosCdpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RubrosCdp  $rubrosCdp
     * @return \Illuminate\Http\Response
     */
    public function show(RubrosCdp $rubrosCdp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RubrosCdp  $rubrosCdp
     * @return \Illuminate\Http\Response
     */
    public function edit(RubrosCdp $rubrosCdp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RubrosCdp  $rubrosCdp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RubrosCdp $rubrosCdp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RubrosCdp  $rubrosCdp
     * @return \Illuminate\Http\Response
     */
    public function destroy(RubrosCdp $rubrosCdp)
    {
        //
    }
}
