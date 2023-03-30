<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ShopList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Str;
use Dotenv\Util\Str as UtilStr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class ItemController extends Controller
{
    //
    
    //ADDING AN ITEM
    public function addAnItem(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_store' => 'required',
            'item_quantity' => 'required',
        ]);

        $result = $request->all();
        $create = $this->create($request);

        return redirect('viewlist')->withSuccess('Successful');
        //return redirect()->back()->withSuccess('Added Successfully');
    }

    public function create(Request $request)
    {
        return Item::create([
            'item_name' => $request->item_name,
            'item_store' => $request->item_store,
            'item_quantity' => $request->item_quantity,
            'shoplist_id' => $request->id,
        ]);
    }
    //UPDATING AN ITEM
    public function updateItem(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_store' => 'required',
            'item_quantity' => 'required',
        ]);

        $id = $request->id;
        $item_name = $request->item_name;
        $item_store = $request->item_store;
        $item_quantity = $request->item_quantity;
        $shoplist_id = $request->shoplist_id;
        
        Item::where('id','=',$id)->update ([
            
            'item_name' => $request->item_name,
            'item_store' => $request->item_store,
            'item_quantity' => $request->item_quantity,
            'shoplist_id' => $request->shoplist_id
        ]);

        return redirect('viewlist')->withSuccess('Successful');
    }

    public function viewListItems(Request $req_id)
    {
        $shopListId = $req_id->id;
        
        $shopDataId = ShopList::where('shoplist_id', '=', $shopListId);
        $data = Item::where('shoplist_id', $shopListId)->get();
        $capsule = array('data' => $data);
        /*
        Log::debug(__METHOD__,[
            "data" => $data, 
            "capsule" => $capsule
        ]);
        */
        //return $data;
        return view('viewitems')->with( $capsule);
        
        
    }

    //DELETE ITEM
    public function deleteitem($id)
    {
       // $shopListId = $req_id->id;        
        //$data = Item::where('id', $shopListId)->delete();
        Item::where('id', $id)->delete();
        //return $data;
        return redirect()->back()->withSuccess('Deleted Successfully');
    }

    //EDIT ITEM
    public function editItems(Request $req_id, $request)
    {


        $shopListId = $req_id->id;
        //$shopDataId = ShopList::where('shoplist_id', '=', $shopListId);
        //$data = Item::where('id','=',$req_id)->first();
        $data = Item::where('id', $shopListId)->first();
        $capsule = array('data' => $data);
        //return $data;
        return view('edititem')->with($capsule);


        /*
        $data = Item::where('id','=',$req_id)->first(); // = not necessary
        //return $data; */
        //return view('edititem', compact($capsule));

    }
}
