<?php

namespace App\Http\Controllers;

use App\Models\Group;
use DateTime;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function index()
    {
        $response = Group::where('active', 1)
                    ->orderByDesc('group_id')
                    ->get();
        return view('backend.private.group.group_list',compact('response'));
    }
    public function new()
    {
        return view('backend.private.group.group_add');
    }
    public function add(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'decription'=>'required'
        ]);
        $group = new Group();
        $group->name = $request->name;
        $group->description = $request->decription;
        $group->create_by = session('user')['user_id'];
        $group->save();
        return redirect()->route('group.index');

    }
    public function edit($group_id)
    {
        $group = Group::find($group_id);
        return view('backend.private.group.group_edit', compact('group'));
    }
    public function update(Request $request, Group $group)
    {
        // return $request;
        $group->name = $request->name;
        $group->description = $request->decription;

        $group->update_by = session('user')['user_id'];
        $group->save();
        return redirect()->route('group.index');
    }
    public function delete(Request $request)
    {
        $business = Group::find($request->id);
        $fecha = new DateTime();
        $fecha->format('U = Y-m-d H:i:s');
        Group::where('active', 1)->where('group_id', $request->id)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'update_by'=>session('user')['user_id'],
            'delete_by'=>session('user')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
