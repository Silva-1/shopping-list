<?php

namespace App\Http\Controllers;

use App\Models\ShopList;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Dotenv\Util\Str as UtilStr;
use Illuminate\Support\Facades\Auth;

class ShoppingListController extends Controller
{
    //
    public function addAList(Request $request) {
        $request->validate([            
            'list_name'=>'required',
            'list_description'=>'required'            
            
        ]);

        $result = $request->all();
        $create = $this->create($request);

        return redirect('viewlist')->withSuccess('Successful');
    }

    public function create (Request $request) {  
       // $account = Auth::user()->id;   
        return ShopList::create([
            'list_name' => $request->list_name,
            'list_description' => $request->list_description,
            'user_id' => $request->id,
        ]);
    }

    public function getList() {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);       
        $data = ShopList::where('user_id', $user_id)->get();
        $capsule = array('data'=>$data);
        //return $data;
        return view('viewlist')->with($capsule);
        //return view('viewlist')->with('lists', $data['lists']);
    }

    //DELETE ITEM
    public function deleteList($id)
    {
       // $shopListId = $req_id->id;        
        //$data = Item::where('id', $shopListId)->delete();
        ShopList::where('id', $id)->delete();
        //return $data;
        return redirect()->back()->withSuccess('Deleted Successfully');
    }

    public function getItems($id) {
        $data = ShopList::where('id','=',$id)->first();
        $capsule = array('data'=>$data);
        //return $data;
        return view('viewitems')->with($capsule);
    }

    //VIEW ITEMS IN LIST
    public function viewListItems($id) {
        $data = ShopList::where('id','=',$id)->first();
        //return $data;
        return view('viewitems', compact('data'));
    }

    //Add an Item
}
