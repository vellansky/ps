<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SliderImg;

class SliderController extends Controller
{
    public function sliderUploadImage(Request $req)
    {
        if( $req->hasFile('file')){

        $filenameWithExt = $req->file('file')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extention = $req->file('file')->getClientOriginalExtension();
        $save = Storage::disk('slider')->put('/', $req->file('file'));

        $url = Storage::disk('slider')->url($save);
        SliderImg::updateOrCreate([
            'slider_id' => $req->id,
        ],
        [
        'name' => $filenameWithExt,
        'path' => $url,
        'slider_id' => $req->id,
        ]);
        return response(null, 200);
        }
    }
    
    public function sliderEditInf(Request $req)
    {
        $sliderID = Slider::updateOrCreate([
            'id' => $req->id,
        ],
        [
        'name' => $req->name,
        'link' => $req->link,
    ]);
        return response($sliderID, 200);
    }


        public function getSliders()
        {
            $slider = Slider::with('img')->get();
            return response($slider, 200);
        }

        public function sliderStatus(Request $req)
        {
            Slider::where('id', '=', $req->id)->update(['status' => $req->status]);
            return response($req->status, 200);

        }
}
 