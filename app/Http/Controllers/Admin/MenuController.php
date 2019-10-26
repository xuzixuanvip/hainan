<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Permission;
use App\Repos\MenuRepo;
use View,Route;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function __construct(MenuRepo $menuRepo)
    {
        $this->menu = $menuRepo;
        View::share('path','system');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $collection = collect();     
        $list       = $this->menu->get_menus($collection,0);
        $menus      = Menu::select('id','name')->get();       
        $weight     = Menu::max('weight')+1;
        return view('hrs.menu.index', compact('list','menus','weight'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        if(!$request->has('id')) {
            return back()->with('rs', ['flag'=>'warning','msg'=>'操作失败']);;  
        }
        $system_id  = $request->id;
        $system     = System::find($system_id);
        $menus      = Menu::select('id','name')->get();
        $sort_id    = Menu::max('sort')+1;
        return view('menu.add',compact('menus','system_id','sort_id','system'));
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
        //添加子级的时候level升级 + 1
        if ($request->get('parent_level')) {
            $level = $request->get('parent_level') + 1;
            $data  = $request->except('parent_level','_token');
            $data['level'] = $level;
        }
        $data = array_except($data,'parent_level');
        $rs   = Menu::create($data);

        if($rs->id) {

            return redirect('system/menu?id='.$rs->system_id)->with('rs', ['flag'=>'success','msg'=>'操作成功']);    
        } else {
            return back()->with('rs', ['flag'=>'warning','msg'=>'操作失败']);;    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rs = Menu::find($id);
        if($rs) {
            return  response()->json(['rs'=>'true','msg'=>'操作成功','data'=>$rs]);    
        } else {
            return response()->json(['rs'=>'false','msg'=>'操作失败']);;    
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token','_method','parent_level']);        
        $rs   = Menu::where('id',$data['id'])->update($data);
        if($rs) {
            return  response()->json(['rs'=>'true','msg'=>'操作成功']);    
        } else {
            return response()->json(['rs'=>'false','msg'=>'操作失败']);;    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rs = Menu::destroy($id);
        if($rs) {
            return  response()->json(['rs'=>'true','msg'=>'操作成功']);    
        } else {
            return response()->json(['rs'=>'false','msg'=>'操作失败']);;    
        }
    }

    /**
    * 菜单权限
    * @param menu_id 菜单id 
    */
    public function menuPermission($menu_id)
    {
        $permissions = Permission::where(['menu_id'=>$menu_id])->get();
        $menu        = Menu::find($menu_id);
        return view('hrs.menu.menu_permission', compact('permissions','menu_id','menu'));
    }
}
