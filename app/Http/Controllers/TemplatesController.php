<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Templates;

use Illuminate\Support\Facades\Auth;


class TemplatesController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        
        $templates = Templates::where('user_id','=', $user_id)->get();
        return view('templates.index', compact('templates'));
    }
    
    public function preview($id) {
        
        return view('templates.preview', compact('templates'));
    }
}
