<?php

namespace App\Http\Controllers\Admin;

use DemeterChain\B;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\kfBody;
use App\Http\Controllers\Admin\Traits\MessageTraits;
use App\Http\Requests\kfBodyRequest;
use App\Models\Kfsymptom;
use  App\Models\BodySymptom;
use App\Filters\BodyFilters;


class BodyController extends Controller
{
    use MessageTraits;
    //
    public function index(BodyFilters $filters,kfBody $body)
    {
        if(request()->name){
            $body = $body->Filter($filters)->paginate(10);
        }else {
            $body = $body->table();
        }
        return view('admin.body.index',compact('body'));
    }

    public function create()
    {
        $body_son = kfBody::PrentBody();
        return view('admin.body.add',compact('body_son'));
    }

    public function store(kfBodyRequest $request,kfBody $body)
    {
        $body->fill($request->except('_token'));
        $body->save();
        return $this->redirect_msg($body,route('body.index'),'创建');
    }

    public function edit(kfBody $body)
    {
        return view('admin.body.edit',compact('body'));
    }

    public function update(kfBodyRequest $request,kfBody $body)
    {
        $body->update($request->except('_token','_method'));
        return $this->redirect_msg($body,route('body.index'),'修改');
    }


    public function delete(Request $request,kfBody $body)
    {
        $body->find($request->id)->delete();
        return $this->json_msg($body);
    }


//    public function deleteAll(Request $request,kfBody $body)
//    {
////        if(is_array($request->ids)){
////            $prent_id = $prent_id->pluck('id');
////        } else {
////        }
//
////        $body->delete_son_id($request->id);
//        return $body->delete_All($request->ids);
//    }

    public function add_symptom(kfBody $body)
    {
        $result = Kfsymptom::get();
        $symptom = $body->symptom;
        return view('admin.body.symptom',compact('body','result','symptom'));
    }

    public function symptom_store(Request $request,BodySymptom $bodysymptom,kfBody $body)
    {
        $bodysymptom->where('body_id',$request->id)->delete();
        $body->find($request->id)->symptom()->attach($request->symptom_id);
        return $this->redirect_msg($body,route('body.index'),'添加');
    }

}
