<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Templates;
use App\User;
use App\Layers;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class TemplatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $user_id = Auth::user()->id;
        $user    = $request->get('user'); 
        
        if(Auth::user()->role == 'SUPER ADMIN'){
            $users   = User::where('status','=','published')->pluck('name', 'id');
            $templates = Templates::getTemplates(array('user'=>$user));
        }
        else{
            $templates = Templates::where('user_id','=', $user_id)->get();
        }
        return view('templates.index', compact('templates','users'));
    }
    
    public function preview($id) {
        $template = Templates::find($id);
        return view('templates.preview', compact('template'));
    }
    public function create() {
        $layers = Layers::all();
        //echo "<pre>"; print_r($layers); echo "</pre>"; exit;
        return view('templates.editor', compact('layers'));
    }
    public function createhtml(Request $request) {
        $folder = "temp";
        if(!file_exists($folder)){
                mkdir($folder,0777);	
        }
        $fname = time();
        $htmlfile  = $folder."/".$fname.".html";
        $content = $request->input('content');
        $header  = '<!DOCTYPE html>
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Email template</title>
                    </head>
                    <body>';
        $footer  = '</body>
                    </html>';
        $content = $header.$content.$footer;		
        if($content){
                file_put_contents($htmlfile,$content);
                echo $fname; exit;
        }
        else{
                echo 'error'; exit;
        }  
    }
    public function draft($id) {
       
        return view('templates.draft', compact('id'));
    }
    public function cropimage(Request $request) {
        $res_image = $request->input('res_image');
        $width = $request->input('width')?$request->input('width'):250;
        $height = $request->input('height')?$request->input('height'):250;

        list($type, $data) = explode(';', $res_image);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        //echo $type; exit;
        $filename = md5(time());

        switch($type){
                case 'image/jpeg':
                case 'image/jpg':
                        $ext = 'jpg';
                break;

                default:
                        $ext = 'png';
                break;
            }
        
        if(@file_put_contents('temp/'.$filename.'.'.$ext, $data)){
            //$res = $this->do_resize($filename.'.'.$ext,$width,$height);
            $image_url = asset("temp/images/".$filename.".".$ext);

        }


        $json['status']    = 'success';
        $json['image_url'] = $image_url;
        $json['type'] = $type;
        $json['res'] = $res;

        echo json_encode($json); exit;
    }
    public function do_resize($filename,$width,$height)
    {
        $folder = "temp/images";
        if(!file_exists($folder)){
                mkdir($folder,0777);	
        }

        $source_path = 'temp/' . $filename;
        $target_path = 'temp/images/'.$filename;

        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('images/ServiceImages/' .$filename));
	
    }
}
