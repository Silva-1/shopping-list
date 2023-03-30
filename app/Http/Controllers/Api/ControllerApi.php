<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Passport\HasApiTokens;
use App\Models\Item;
use App\Models\ShopList;

class ControllerApi extends Controller
{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests; 
    
    public function home() {
        return view('home');
    }
    public function additem(Request $req_id) {     


        $shopListId = $req_id->id;
        $data = Item::where('id', $shopListId)->first();
        $capsule = array('data' => $data);
        //return $capsule;
        return view('additem2')->with($capsule);
        
        //return view('additem');
    }

    
    public function additem2(Request $req_id) {       

        $shopListId = $req_id->id;
        $data = ShopList::where('id', $shopListId)->first();
        $capsule = array('data' => $data);
        return view('additem')->with($capsule);
        
   
    }    
        
    public function addlist() {
        return view('addlist');
    }
    public function edititem() {
        return view('edititem');
    }
    public function welcome() {
        return view('welcome');
    }
    
}
