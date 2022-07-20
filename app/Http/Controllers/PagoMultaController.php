<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Multa;
use App\ProntoPago;

class PagoMultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos=ProntoPago::get();
        $multas=Multa::get();
        $title="Pronto pagos y multas";
        return view("admin.pagosmulta.index",compact("title","pagos","multas"));
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
        
        $xc=$request->porciento=="si"?true:false;
        $xd=$request->pordia=="si"?true:false;
        if("pago"==$request->tipo){
            $new=new ProntoPago($request->all());
            $new->porciento=$xc;
            $new->pordia=$xd;
            $new->save();

        }else{
            $new=new Multa($request->all());
            $new->porciento=$xc;
            $new->pordia=$xd;
            $new->save();
        }
        return redirect()->back();
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
