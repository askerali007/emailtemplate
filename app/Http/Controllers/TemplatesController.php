<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Templates;
use App\User;

use Illuminate\Support\Facades\Auth;


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
}
