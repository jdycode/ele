<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class NavController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except("login");
    }
    /*
     * 首页展示
     */
    public function index()
    {
        //得到所有数据
        $data = Nav::paginate(6);
        //显示视图
        return view('admin.nav.index', compact('data'));
    }

    /*
     * 添加导航
     */
    public function add(Request $request)
    {
        //判断是不是post传值
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required'
            ]);
            //判断路由
            if ($request->post('url') === null) {
                $data = $request->except('url');
            } else {
                $data = $request->post();
            }
            $nav = Nav::create($data);
            return redirect()->refresh()->with('success', '添加' . $nav->name . '成功');
        }

        //得到所有的路由
        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        //定义一个数组来存路由
        $urls = [];
        foreach ($routes as $k => $v) {
            if ($v->action['namespace'] === 'App\Http\Controllers\Admin') {         //通过别名获取路由
                if (isset($v->action['as'])) {
                    $urls[] = $v->action['as'];
                }
            }
        }
        //通过1级目录排序
        $navs = Nav::where('pid', 0)->orderBy('sort')->get();
        //显示视图
        return view('admin.nav.add', compact('urls', 'navs'));
    }

    /*
     * 删除
     */
    public function del($id)
    {
        //通过id找到单前数据
        $nav = Nav::where('pid', $id)->get();
        if (!$nav) {
            Nav::findOrFail($id)->deleted();
            return redirect()->route('nav.index')->with('succsse', '删除成功');
        }
    }
}
