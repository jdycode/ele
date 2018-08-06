<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/8/3
 * Time: 11:42
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except("login");
    }
    /*
     * 展示
     */
    public function index()
    {
//获取所有权限
        $pers = Permission::all();
        return view('admin.per.index', compact('pers'));
    }

    /*
     * 添加权限
     */
    public function add(Request $request)
    {
        //1.得到所有路由
        $routes = Route::getRoutes();
//            dump($route);
        //2.过滤命名空间
        //3.声明空数组
        $urls=[];
        //2.过滤出命名空间是 App\Http\Controllers\Admin 路由
        foreach ($routes as $route){
            if ($route->action['namespace']==="App\Http\Controllers\Admin") {
//                dump($route->action['as']);
                //判断是否存在名字
                if (isset($route->action['as'])){
                    $urls[]=$route->action['as'];
                }
            }
        }

        return view('admin.per.add',compact('urls'));
    }

    /*
     * 编辑
     */
    public function edit(Request $request, $id)
    {
        //通过id找当前对象
        $pers = Permission::findOrFail($id);
        //验证
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required',
                'guard_name' => 'required'
            ]);
            //更新数据
            $data = $request->post();
            $pers->update($data);
        }

        return view('admin.per.edit', compact('pers'));
    }

    /*
     * 删除
     */
    public function del($id)
    {
        $pers = Permission::findOrFail($id);
        //删除数据
        $pers->delete();
        //跳转 提示
        return redirect()->route('per.index')->with('success', '删除成功');
    }
}