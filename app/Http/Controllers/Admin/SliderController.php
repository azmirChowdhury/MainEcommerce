<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    public function index()
    {
        $slider = SliderModel::all();
        return view('back_end.slider.slider_manage', ['sliders' => $slider]);
    }

    public function slider_add()
    {

        return view('back_end.slider.slider_add');
    }

    public function validation($request)
    {
        $this->validate($request, [
            'slider_title' => 'required',
            'slider_description' => 'required',
            'status' => 'required|integer|min:0|max:1',
        ]);
    }

    private function slider_image_upload($request)
    {
        $this->validate($request, [
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $rand = rand(9999, 999999);
        $this_file = $request->file('slider_image');
        $extensition = $this_file->getClientOriginalExtension();
        $directory = 'back_end/images/slider_images/';
        $stitle = str_replace(' ', '_', $request->slider_title);
        $image_name = $directory . $rand . $stitle . '.' . $extensition;
        Image::make($this_file)->resize(1170, 569)->save($image_name);
        return $image_name;
    }

    private function slider_image_delete($id)
    {
        $slider = SliderModel::find($id);
        unlink($slider->slider_image);
    }

    private function slider_data_insert($request, $image_name, $work)
    {
        if ($work == 'i') {
            $slider = new SliderModel();
        } else {
            $slider = SliderModel::find($request->id);
        }
        $slider->slider_title = $request->slider_title;
        $slider->slider_description = $request->slider_description;
        $slider->slider_image = $image_name;
        $slider->button_name = $request->button_name;
        $slider->button_color = $request->color_name;
        $slider->button_url = $request->button_url;
        $slider->status = $request->status;
        return $slider;
    }

    public function save_slider(request $request)
    {
        $this->validation($request);
        if ($request->button_name || $request->color_name == true) {
            $this->validate($request, [
                'button_name' => 'required',
                'color_name' => 'required',
                'button_url' => 'required',
            ]);
        }
        $image_name = $this->slider_image_upload($request);
        if ($image_name) {
            $slider = $this->slider_data_insert($request, $image_name, 'i');
            if ($slider == true) {
                $slider->save();
                return redirect('/dashboard/appearance/slider-add')->with('massage', 'Slider ' . $request->slider_title . ' save successful');
            } else {
                echo 'data not insert';
            }
        } else {
            echo 'Image not insert';
        }
    }

    public function edit_slider($id)
    {
        $slider = SliderModel::find($id);
        if ($slider != null) {
            return view('back_end.slider.edit_slider', ['slider' => $slider]);
        } else {
            return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider was deleted');
        }
    }

    public function edit_slider_save(Request $request)
    {
        $this->validation($request);
        $this->validate($request, [
            'id' => 'required',
        ]);
        $slider = SliderModel::find($request->id);
        if ($slider != null) {
            if ($request->button_name || $request->color_name == true) {
                $this->validate($request, [
                    'button_name' => 'required',
                    'color_name' => 'required',
                    'button_url' => 'required',
                ]);
            }
            if (file_exists($request->slider_image) == true) {
                $this->validate($request, [
                    'slider_image' => 'required|image|mimes:jpg,png,svg,bmp,jpeg'
                ]);
                $this->slider_image_delete($request->id);
                $image_name = $this->slider_image_upload($request);
                if ($image_name) {
                    $slider = $this->slider_data_insert($request, $image_name, 'u');
                    if ($slider == true) {
                        $slider->update();
                    } else {
                        echo 'data not insert';
                    }
                } else {
                    echo 'Image not insert';
                }
            } else {
                $image_name = $request->image;
                $slider = $this->slider_data_insert($request, $image_name, 'u');
                if ($slider == true) {
                    $slider->update();
                } else {
                    echo 'data not insert';
                }
            }
        } else {
            return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider was deleted');
        }
        return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider ' . $request->slider_title . ' update successful');


    }

    public
    function slider_publish($id)
    {
        $slider = SliderModel::find($id);
        if ($slider != null) {
            $slider->status = 1;
            $slider->update();
        } else {
            return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider was deleted');
        }
        return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider ' . $slider->slider_title . ' status update successful');
    }

    public
    function slider_unpublished($id)
    {
        $slider = SliderModel::find($id);
        if ($slider != null) {
            $slider->status = 0;
            $slider->update();
        } else {
            return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider was deleted');
        }
        return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider ' . $slider->slider_title . ' status update successful');
    }

    public
    function slider_delete($id)
    {
        $slider = SliderModel::find($id);
        if ($slider != null) {
            $this->slider_image_delete($id);
            $slider->delete();
        } else {
            return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider was deleted');
        }
        return redirect('/dashboard/appearance/slider-manage')->with('massage', 'Slider delete successful');
    }
}
