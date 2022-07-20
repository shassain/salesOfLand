<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Proyecto;
use Image;
use App\Imgproyect;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Temporal;
class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Proyecto::with("imagenes")->get();
        
        $title = 'Listado de Proyecto';
        
        return view('admin.proyecto.index', compact('title', 'proyectos'));
    }
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temps=Temporal::where('user_id',Auth::user()->id)->where('tipo','proyecto')->get();
        $title = 'Crear Proyecto';        
        $i=0;
        $res1=$res2=[];
        foreach ($temps as $temp) {
            $key=$temp->id;
            $url=\Illuminate\Support\Facades\Request::root().'/eliminararchivo/'.$temp->id;
            $res1[$i] = ''.$temp->image;
            $nombre = $this->generateRandomString();
            $ctime=Carbon::now()->toDateString();
            $nombre=base64_encode($nombre.$ctime);
            $token=csrf_token();
            $res2[$i]= ['caption' => $nombre.'.jpg', 'size' => 732762, 'width' => '120px', 'url' => $url, 'key' => $key,'extra'=>['_token'=>$token]];
            $i++;
        }
        return view('admin.proyecto.create',compact('title',"res1","res2"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->all();
        $new=new Proyecto(request()->all());
        $new->save();
        $temps=Temporal::where('user_id',Auth::user()->id)->where('tipo','proyecto')->get();
        foreach ($temps as $key) {
            $img=new Imgproyect();
            $img->url=$key->image;
            $img->posx=$request->posx;
            $img->posy=$request->posy;
            $img->base64=$key->base64;
            $img->mini=$key->minimagen;
            $img->proyecto_id=$new->id;
            $imagen=Image::make(asset($img->url));
            $img->xmaximo=$imagen->width();
            $img->ymaximo=$imagen->height();
            $img->save();
        }
        Temporal::where('user_id',Auth::user()->id)->where('tipo','proyecto')->delete();

        return redirect()->route('proyecto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto=Proyecto::with("imagenes")->find($id);
        $imagen=$proyecto->imagenes->where("enmapa",true)->first();
        if($imagen==null){

        }
        $imagenes=$proyecto->imagenes;
        $title="Poryecto $proyecto->nombre";
        return view("admin.proyecto.show",compact("proyecto","imagen","imagenes","title"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto=Proyecto::with("imagenes")->find($id);
        
        $temps=$proyecto->imagenes;
        $title = 'Editar Proyecto';        
        $i=0;
        $res1=$res2=[];
        foreach ($temps as $temp) {
            $key=$temp->id;
            $url=\Illuminate\Support\Facades\Request::root().'/eliminararchivo/'.$temp->id;
            $res1[$i] = ''.$temp->url;
            $nombre = $this->generateRandomString();
            $ctime=Carbon::now()->toDateString();
            $nombre=base64_encode($nombre.$ctime);
            $token=csrf_token();
            $res2[$i]= ['caption' => $nombre.'.jpg', 'size' => 732762, 'width' => '120px', 'url' => $url, 'key' => $key,'extra'=>['_token'=>$token]];
            $i++;
        }
        return view('admin.proyecto.edit',compact("proyecto","title","res1","res2"));
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
        $data = request()->all();
        $new=new Proyecto(request()->all());
        $new->save();
        $temps=Temporal::where('user_id',Auth::user()->id)->where('tipo','proyecto')->get();
        foreach ($temps as $key) {
            $img=new Imgproyect();

            $img->url=$key->image;
            $img->posx=$request->posx;
            $img->posy=$request->posy;
            $img->base64=$key->base64;
            $img->mini=$key->minimagen;
            $img->proyecto_id=$new->id;
            $img->save();
        }
        Temporal::where('user_id',Auth::user()->id)->where('tipo','proyecto')->delete();

        return redirect()->route('proyecto.index');
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
    public function imagentemporal(Request $request){
        try{
            $tipo=Input::get('tipo');
            $res1 = $res2 = [];
            $token=Input::get('_token');
            for($i=0;$i<count(Input::file('imagen'));$i++){
                if(file_exists(Input::file('imagen')[0])){
                    $file=Input::file('imagen')[$i];
                    $nombre = $file->getClientOriginalName();
                    $ctime=$file->getCTime();
                    $nombre=base64_encode($nombre.$ctime);
                    $year=Carbon::now()->year;


                    $path=public_path().'/imagenes/'.$year.'/'.$nombre;
                    $pathmini=public_path().'/imagenes/'.$year.'/miniatura/'.$nombre;
                    if(!File::exists(public_path('imagenes/'.$year))){
                        File::makeDirectory(public_path('imagenes/'.$year),0777,true);
                    }
                    if(!File::exists(public_path('imagenes/'.$year.'/miniatura'))){
                        File::makeDirectory(public_path('imagenes/'.$year.'/miniatura'),0777,true);
                    }
                    
                    set_time_limit(0);
                    ini_set("memory_limit",-1);
                    ini_set('max_execution_time', 0);
                    $image=Image::make($file);
                    $miniatura=Image::make($file);
                    $miniatura->resize(100,100);
                    //$image->opacity(0);
                    $image->save($path.$file->getClientOriginalExtension());
                    $miniatura->save($pathmini.$file->getClientOriginalExtension());
                    $im=file_get_contents($path.$file->getClientOriginalExtension());
                    $bytes=base64_encode($im);
                    $temporal=new Temporal();
                    $temporal->base64=$bytes;
                    

                    $temporal->image='/imagenes/'.$year.'/'.$nombre.$file->getClientOriginalExtension();
                    $temporal->minimagen='/imagenes/'.$year.'/miniatura/'.$nombre.$file->getClientOriginalExtension();
                    

                    $temporal->tipo=$tipo;
                    $temporal->user_id=Auth::user()->id;
                    $temporal->save();
                    $key=$temporal->id;
                    $url = \Illuminate\Support\Facades\Request::root().'/eliminararchivo/'.$temporal->id;
                    $res1[$i] = \Illuminate\Support\Facades\Request::root().$temporal->image;
                    $res2[$i] = ['caption' => $temporal->image, 'size' => 732762, 'width' => '120px', 'url' => $url, 'key' => $key,'extra'=>['_token'=>$token]];
                }
                else{
                    $output = ['error'=>"Error el archivo no es valido"];
                    return json_encode($output);
                }
            }
            return json_encode([
                'initialPreview' => $res1,
                'initialPreviewConfig' => $res2,
                'append' => true
            ]);

        }catch (\Exception $e){
            $output = ['error'=>"Error al almacenar las imagenes intente de nuevo"];
            return json_encode($output);
        }
    }
    public function eliminar($id){
        $img=Temporal::find($id);
        File::delete(public_path().$img->image);
        File::delete(public_path().$img->minimagen);
        $img->delete();
        $output = [];
        return json_encode($output);
    }
    public function asignar($id){
        $proyecto=Proyecto::with("imagenes")->find($id);


        $imagenes=$proyecto->imagenes;
        
        $title="Asignar Mapa";
        return view('admin.proyecto.asignarmapa',compact("proyecto","title","imagenes"));
    }
    public function asignarimg($id){
        $proyecto=Proyecto::with("imagenes")->find($id);
        $imagenes=$proyecto->imagenes;
        $title="Asignar Mapa";
        return view('admin.proyecto.asignarimg',compact("proyecto","title","imagenes"));
    }
    public function promo(Request $request,$id){
        if($request->id_img!=0){
            $res=\DB::statement("UPDATE imgproyects SET promocional=false WHERE proyecto_id=?",[$id]);
            $img=Imgproyect::find($request->id_img);
            $img->promocional=true;
            $img->save();
            return redirect()->route("proyecto.index");
        }else{
            $notification = [
                'type' => 'error',
                'message' => "Seleccione una imagen primero"
            ];
            return redirect()->back()->with("notification",$notification);
        }
    }
    public function seleccionimagen(Request $request){
        $img=Imgproyect::find($request->id);
        return response()->json($img);
    }
    public function savemapeste(Request $request){
        if($request->id_img!=0){
            
            $img=Imgproyect::find($request->id_img);
            $res=\DB::statement("UPDATE imgproyects SET enmapa=false WHERE proyecto_id=?",[$img->proyecto_id]);
            $img->fill($request->all());
            $img->enmapa=true;
            $img->save();
            return redirect()->route("proyecto.index");
        }else{

        }
    }
}

