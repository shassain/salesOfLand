<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use Image;
use App\Imgproyect;
use App\Categorias;
use App\Coordenadas;
use App\Terreno;
class TerrenoController extends Controller
{
    public function index($id){
    	$proyecto=Proyecto::find($id);
    	$imagen=Imgproyect::where("proyecto_id",$id)->where("enmapa",true)->first();
    	$categoria=Categorias::all();
    	$title="Asignar terreno";
    	if($imagen!=null){
    		return view("admin.terreno.index",compact("proyecto","imagen","title","categoria"));
    	}else{
    		$notification = [
                'type' => 'error',
                'message' => "No existe mapa asignado a este proyecto. Primero Asigne una imagen de referencia"
            ];
    		return redirect("asing_map/$id")->with('notification', $notification);
    	}
    	
    }
    public function store(Request $request, $id){
		try{
			$terreno=new Terreno($request->all());
			$terreno->estado="disponible";
			$terreno->proyecto_id=$id;
			$terreno->save();
			$xp=$request->x;
			$yp=$request->y;
			for($i=0;$i<count($xp);$i++){
				$nuevo=new Coordenadas();
				$nuevo->terreno_id=$terreno->id;
				$nuevo->posy=$yp[$i];
				$nuevo->posx=$xp[$i];
				$nuevo->save();
			}
	    	return response()->json(["resp"=>200,"msn"=>"Se almacenaron correctamento los datos"]);
		}catch(\Exception $e){
			return response()->json(["resp"=>300,"msn"=>$e->getMessage()]);
		}
    }
    public function coordenadas($id){
    	$proyecto=Proyecto::with("terrenos.coordenadas","terrenos.Categoria")->find($id);
		return response()->json($proyecto);    	
    }
    public function coordenadasAll(){
        $proyecto=Proyecto::with("terrenos.coordenadas","terrenos.Categoria")->get();
        return response()->json($proyecto);     
    }
    public function show(Request $request){
        $id= $request->id;
        $data=Terreno::with("categoria","proyecto")->find($id);
        if($data==null){
            return response()->json(["resp"=>300,"msn"=>"El dato no pudo ser encontrado"]); 
        }else{
            return response()->json(["resp"=>200,"dato"=>$data,"msn"=>"Dato encontrado"]);    
        }
    }
    public function update(Request $request){
        $id= $request->edit_id;
        $data=Terreno::find($id);
        $data->fill($request->all());
        $data->save();
        if($request->ajax()){
            return response()->json(["resp"=>200,"dato"=>$data,"msn"=>"Dato Editado Correctamente"]);
        }else{
            return redirect()->back();    
        }
        
    }
}
