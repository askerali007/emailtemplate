<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    static function getUserByFilter($filter){
          // echo "<pre>"; print_r($filter); echo "</pre>"; exit;
        
        //DB::enableQueryLog();
        if($filter['s']){
            /*$users = User::whereIn('status',  $filter['status'])
                        ->where(function($query){
                            $query->where('name', 'LIKE', '%'.$s.'%')
                                    ->orWhere('email', 'LIKE', '%'.$s.'%');
                        })->paginate($filter['limit']);*/
          
            $users = User::whereIn( 'status', $filter['status'])
                    ->where( function ( $query ) use ($filter)
                    {
                        
                        $query->where( 'name', 'LIKE', '%'.$filter['s'].'%')
                            ->orWhere( 'email', 'LIKE', '%'.$filter['s'].'%' );
                    })->paginate($filter['limit']);
          // dd(DB::getQueryLog());
        }
        else{
            $users = User::whereIn('status', $filter['status'])->paginate($filter['limit']);
        }
        
       
         
            
        $users->appends(['s' => $filter['s'], 'limit'=>$filter['limit'] ]);
        return $users;
    }
}
