<?php

namespace App\Http\Controllers\Admin;

use DemeterChain\B;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Body;
use App\Http\Controllers\Admin\Traits\MessageTraits;
use App\Http\Requests\BodyRequest;

class BodyController extends Controller
{
    use MessageTraits;
    //
    public function index(Body $body)
    {
        $body = $body->table();
        return view('admin.body.index',compact('body'));
    }

    public function create()
    {
        $body_son = Body::PrentBody();
        return view('admin.body.add',compact('body_son'));
    }

    public function store(BodyRequest $request,Body $body)
    {
        $body->fill($request->except('_token'));
        $body->save();
        return $this->redirect_msg($body,route('body.index'),'创建');
    }

    public function edit(Body $body)
    {
        return view('admin.body.edit',compact('body'));
    }

    public function update(BodyRequest $request,Body $body)
    {
        $body->update($request->except('_token','_method'));
        return $this->redirect_msg($body,route('body.index'),'修改');
    }


}
