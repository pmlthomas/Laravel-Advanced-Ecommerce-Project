<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Image;

class HomeSliderController extends Controller
{
    public function SliderView()
    {
        $allSliders = HomeSlider::all();
        return view('admin.home_slider.sliders', compact('allSliders'));
    }

    public function AddSliderPage()
    {
        return view('admin.home_slider.add_slider');
    }

    public function StoreSlider(Request $request)
    {
        $this->validate($request, [
            'slider_title_fr' => 'required',
            'slider_title_en' => 'required',
            'slider_subtitle_fr' => 'required',
            'slider_subtitle_en' => 'required',
            'slider_topleft_title_fr' => 'required',
            'slider_topleft_title_en' => 'required',
            'slider_image' => 'required',
        ], [
            'required' => '*Cet élément doit être renseigné',
        ]);

        if ($request->hasFile('slider_image')) {
            if ($request->file('slider_image')->isValid()) {
                $file = $request->file('slider_image');
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

                Image::make($file)->resize(870, 370)->save(public_path('backend/upload/home_sliders/').$filename);
            
                $slider_image = 'backend/upload/home_sliders/'.$filename;

                HomeSlider::insert([
                    'slider_title_fr' => $request->slider_title_fr,
                    'slider_title_en' => $request->slider_title_en,
                    'slider_subtitle_fr' => $request->slider_subtitle_fr,
                    'slider_subtitle_en' => $request->slider_subtitle_en,
                    'slider_topleft_title_fr' => $request->slider_topleft_title_fr,
                    'slider_topleft_title_en' => $request->slider_topleft_title_en,
                    'slider_image' => $slider_image,
                ]);
                
                return redirect('/admin/sliders');
            }
        }
        return redirect()->back();
    }

    public function EditSliderPage($id)
    {
        $old_slider = HomeSlider::find($id);
        return view('admin.home_slider.edit_slider', compact('old_slider'));
    }

    public function UpdateSlider(Request $request)
    {
        $old_slider = HomeSlider::find($request->id);

        $this->validate($request, [
            'slider_title_fr' => 'required',
            'slider_title_en' => 'required',
            'slider_subtitle_fr' => 'required',
            'slider_subtitle_en' => 'required',
            'slider_topleft_title_fr' => 'required',
            'slider_topleft_title_en' => 'required',
            'slider_image' => 'required',
        ], [
            'required' => '*Cet élément doit être renseigné',
        ]);

        if ($request->hasFile('slider_image')) {
            if ($request->file('slider_image')->isValid()) {
                $file = $request->file('slider_image');
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

                Image::make($file)->resize(870, 370)->save(public_path('backend/upload/home_sliders/').$filename);
            
                $slider_image = 'backend/upload/home_sliders/'.$filename;

                $old_slider->update([
                    'slider_title_fr' => $request->slider_title_fr,
                    'slider_title_en' => $request->slider_title_en,
                    'slider_subtitle_fr' => $request->slider_subtitle_fr,
                    'slider_subtitle_en' => $request->slider_subtitle_en,
                    'slider_topleft_title_fr' => $request->slider_topleft_title_fr,
                    'slider_topleft_title_en' => $request->slider_topleft_title_en,
                    'slider_image' => $slider_image,
                ]);
                return redirect('/admin/sliders');
            }
        } else {
            redirect()->back();
        }
    }

    public function DeleteSlider($id)
    {
        $slider = HomeSlider::findOrFail($id);
        $image = $slider->slider_image;
        unlink($image);
        HomeSlider::findOrFail($id)->delete();

        return redirect('/admin/sliders');
    }

    public function ActivateSlider($id)
    {
        HomeSlider::find($id)->update(['status' => 1]);
        return redirect('/admin/sliders');
    }

    public function InactivateSlider($id)
    {
        HomeSlider::find($id)->update(['status' => 0]);
        return redirect('/admin/sliders');
    }
}
