<?php

namespace App\Http\Controllers\Dz;

use App\Models\kfBody;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DzController extends Controller
{
    public function index()
    {
        $content = \DB::table('kf_content')->get()->all();
        $status = \DB::table('kf_content_status')->get()->pluck('status','cid');
        return view('daozhen.index',compact('content','status'));
    }

    public function body()
    {
        return view('daozhen.body');
    }


    public function bodyList(Request $request,kfBody $body)
    {
        $data = \DB::select('SELECT * FROM kf_bodys WHERE (id = ? OR pid = ?) AND (sex = ? OR sex = ?)',[$request->bodyid,$request->bodyid,$request->sex,0]);
        $son = $body->with('symptom')->find($data[0]->id)->symptom->pluck('name','id');
        return view('daozhen.bodyList',compact('data','son'));
    }

    public function symptom(Request $request)
    {
        if(!$request->symptom_name){
            return redirect(route('daozhen.index'));
        }
        return view('daozhen.symptom');
    }

    public  function diseaseRetrieve(Request $request)
    {

        return view('daozhen.diseaseRetrieve');
    }


    public function search(Request $request)
    {
        if(!$request->symptom_name){
            return redirect(route('daozhen.index'));
        }
        return view('daozhen.search');
    }
}
