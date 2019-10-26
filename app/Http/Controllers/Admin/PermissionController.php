<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use Illuminate\Http\Request;
use View;

class PermissionController extends Controller
{
	public function __construct()
    {
		View::share('path', 'system');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		if (!$request->has('id')) {
			return back()->with('rs', ['flag' => 'warning', 'msg' => '操作失败']);
		}
		$system_id = $request->id;

		$list = Permission::where(['system_id' => $system_id])->paginate(12);
		$system = System::find($system_id);
		return view('hrs.permission.index', compact('list', 'id', 'system', 'system_id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) 
    {
		if (!$request->has('id')) {
			return back()->with('rs', ['flag' => 'warning', 'msg' => '操作失败']);
		}
		$system_id = $request->id;
		$where['system_id'] = $system_id;
		$permissions = Permission::where($where)->select('id', 'name')->get();
		return view('permission.add', compact('system_id', 'permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) 
    {
		$data = $request->except('_token');
		$data = array_map('trim', $data);
		$rs = Permission::create($data);
		if ($rs->id) {
			return back()->with('rs', ['flag' => 'success', 'msg' => '操作成功']);
		} else {
			return back()->with('rs', ['flag' => 'warning', 'msg' => '操作失败']);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$rs = Permission::find($id);
		if ($rs) {
			return response()->json(['rs' => 'true', 'msg' => '操作成功', 'data' => $rs]);
		} else {
			return response()->json(['rs' => 'false', 'msg' => '操作失败']);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$data = $request->except(['_token', '_method']);
		$data = array_map('trim', $data);
		$rs = Permission::where('id', $data['id'])->update($data);
		if ($rs) {
			return response()->json(['rs' => 'true', 'msg' => '操作成功']);
		} else {
			return response()->json(['rs' => 'false', 'msg' => '操作失败']);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$rs = Permission::destroy($id);
		if ($rs) {
			return response()->json(['rs' => 'true', 'msg' => '操作成功']);
		} else {
			return response()->json(['rs' => 'false', 'msg' => '操作失败']);
		}
	}
}
