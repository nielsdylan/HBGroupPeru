<?php

namespace App\Http\Controllers;

use App\Models\Business;
use DateTime;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    //
    public function index()
    {
        $response = Business::where('active', 1)->get();
        // return $response->business_id;
        return view('backend.private.business.business_list', compact('response'));
    }
    public function new()
    {
        return view('backend.private.business.business_add');
    }
    public function add(Request $request)
    {
        $request->validate([
            'image'=>'required|image|max:200',
            'name'=>'required'
        ]);
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destination = public_path('uploads/business');
        $request->image->move($destination, $name);

        $businesses = new Business();
        $businesses->name = $request->name;
        $businesses->image = $name;

        $businesses->created_by = session('user')['user_id'];
        $businesses->save();
        return redirect()->route('business.index');
    }
    public function edit($business_id)
    {
        $business = Business::where('business_id', $business_id)
                    ->where('active', 1)
                    ->first();
        return view('backend.private.business.business_edit', compact('business'));
    }
    public function update(Request $request, Business $business )
    {
        if ($request->image) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('uploads/business');
            $request->image->move($destination, $name);
            $business->image = $name;
        }
        $business->name = $request->name;
        $business->updated_by = session('user')['user_id'];
        $business->save();
        return redirect()->route('business.index');
    }
    public function delete(Request $request)
    {
        $business = Business::find($request->id);
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Business::where('active', 1)->where('business_id', $request->id)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'updated_by'=>session('user')['user_id'],
            'deleted_by'=>session('user')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
