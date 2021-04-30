<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function index()
    {
        # code...
        $response = Slider::where('active', 1)
                    ->take(3)
                    ->get();
        return view('backend.private.slider.slider_list', compact('response'));
    }
    public function edit($slider_id)
    {
        $slider = Slider::where('slider_id', $slider_id)
                    ->where('active', 1)
                    ->first();
        return view('backend.private.slider.slider_edit', compact('slider'));
    }
    public function update(Request $request,Slider $slider)
    {
        $request->validate([
            'image'=>'required|image|max:2024'
        ]);
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destination = public_path('uploads/slider');
        $request->image->move($destination, $name);

        $slider->name = $request->name;
        $slider->image = $name;
        $slider->save();
        return redirect()->route('slider.index');
    }
}
