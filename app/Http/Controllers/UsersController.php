<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Auth;
use Redirect;

class UsersController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $status=''){
       
        $filter['status'] = ($status=='all' || $status =='')?array('published','draft'):array($status);
        $filter['s']      = $request->get('s'); 
        
    	$filter['limit']  = $request->input('limit')?$request->input('limit'):config('settings.pagination_limit');
        $trashed = 0;
        $active  = 0;
        if($status == 'trashed')
            $actions = array(''=>'Bulk action','publish'=>'Restore','delete'=>'Delete Permanently');
        else if($status == 'all' || $status == 'published')
            $actions = array(''=>'Bulk action','edit'=>'Edit','trash'=>'Move to trash');
        else
            $actions = array();
        
    	$users = User::getUserByFilter($filter);
        //$queries = DB::enableQueryLog();

    	//echo "<pre>"; print_r($queries); echo "</pre>"; exit;
    	return view('users.index', compact('users','status','filter','actions'));
    }
    public function view($id){

    	if($id){
			$user = User::where('id', $id)->first();
    		return view('users.view', compact('user'));
    	}
    	else
    	{
    		return view('users.404');
    	}
    }
    public function update(Request $request) {
        $ids    = $request->input('ids');
        $action = $request->input('action');
        
        $idsArray = $ids?explode(',', $ids):null;
       
       // echo "<pre>"; print_r($ids); echo "</pre>"; exit;
        if(sizeof($idsArray) == 0){
            return redirect()->back()->with('error', 'Please select at least one record');
            //return Redirect::back()->withErrors(['error_msg', 'Please select atleast one record']);
        }
        switch($action){
            
            case 'trash':
                    User::whereIn('id', $idsArray)->update(['status' => 'trashed']);
                    return redirect()->back()->with('message', 'Record(s) has been moved to trash.');
                break;
            
            case 'publish':
                User::whereIn('id', $idsArray)->update(['status' => 'published']);
                break;
            
            case 'delete':
                User::whereIn('id', $idsArray)->delete();
                break;
            
            default:
                return redirect()->back()->with('error', 'Please select any action');
                break;                
        }
        return redirect()->back()->with('message', 'Record(s) has been updated.');
       // return redirect()->route('users.index')->with(['message', 'Record(s) has been updated.']);
      
    }
    public function profile() {
        $user = Auth::user();
        return view('users.view', compact('user'));
    }
    	
}
