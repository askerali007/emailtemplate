<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class Templates extends Model
{
    //
    static function getTemplates($param) {
       // $query = new Templates();
        $query = DB::table('templates');  
            
        $query->join('users', 'users.id', '=', 'templates.user_id')->select('templates.*','users.name as owner'); 
        if( $param['user'] ){
            $query->where('users.id','=',$param['user']);
        }

        $templates = $query->get();
        return  $templates;
    }
}
