<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/23
 * Time: 18:31
 */

namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->except("login");
    }

    /*
     * 首页
     */
    public function index()
    {
        //1.找到当前用户
        $user = Auth::user();
        $shopId = $user->shop_id;
        //得到用户的所有商品分类
        $cates = MenuCategory::where('shop_id', $shopId)->get();
        //接收参数
        $minPrice = request()->input('minPrice');
        $maxPrice = request()->input('maxPrice');
        $keyword = request()->input('keyword');
        $cateId = request()->input('cate_id');

        $query = Menu::orderBy('id');

        if ($minPrice !== null) {
            $query->where('goods_price', '>=', $minPrice);
        }
        if ($maxPrice !== null) {
            $query->where('goods_price', '<=', $maxPrice);
        }
        if ($keyword !== null) {
            $query->where('goods_name', 'like', "%{$keyword}%");
        }
        if ($cateId !== null) {
            $query->where('category_id', 'like', "%{$cateId}%");
        }

        $menus = $query->paginate(3);

        return view("shop.menu.index", compact('cates', 'menus'));
    }

    /*
    * 添加
    */
    public function add(Request $request)
    {
        //得到所有当前用户菜品分类
        //1.找到当前用户
        $user = Auth::user();
        $shopId = $user->shop_id;
        //得到用户的所有商品分类
        $cates = MenuCategory::where('shop_id', $shopId)->get();
        //判断是否POST提交
        if ($request->isMethod('post')) {
            //接收值
            //判断同店铺同分类菜名是否有相同
            $num = Menu::where('goods_name', $request->post('goods_name'))->where('shop_id', $shopId)->where('category_id', $request->post('category_id'))->count();
            if ($num) {
                return back()->with('danger', '已有同名菜品');
            }
            $data = $request->post();
//           //处理图片
            if ($request->file('goods_img')) {
                $fileName = $request->file('goods_img')->store('jdyo', 'oss');
                $data['goods_img'] = env("ALIYUN_OSS_URL") . $fileName;
            }
            $data['shop_id'] = $shopId;
            //入库
            if (Menu::create($data)) {
                //跳转
                return redirect()->route('menu.index')->with('success', '添加成功');
            }
        }
        return view('shop.menu.add', compact('cates'));

    }

    /*
    * 编辑
    */
    public function edit(Request $request,$id)
    {
        $menu = Menu::findOrFail($id);
        //得到所有当前用户菜品分类
        //1.找到当前用户
        $user = Auth::user();
        $shopId = $user->shop_id;
        //得到用户的所有商品分类
        $cates = MenuCategory::where('shop_id', $shopId)->get();
        //判断是否POST提交
        if ($request->isMethod('post')) {
            //接收值
            //判断同店铺同分类菜名是否有相同
            $num = Menu::where('goods_name', $request->post('goods_name'))->where('shop_id', $shopId)->where('category_id', $request->post('category_id'))->count();
            if ($num) {
                return back()->with('danger', '已有同名菜品');
            }
            $data = $request->post();
//           //处理图片
            if ($request->file('goods_img')) {
                $fileName = $request->file('goods_img')->store('jdyo', 'oss');
                $data['goods_img'] = env("ALIYUN_OSS_URL") . $fileName;
            }
            $data['shop_id'] = $shopId;
            //入库
            if ($menu->update($data)) {
                //跳转
                return redirect()->route('menu.index')->with('success', '修改成功');
            }
        }

        return view('shop.menu.add', compact('cates', 'menu'));

    }


    /*
     * 删除
     */

    public function del($id)
    {
        //  通过id找到单前对象
        $menu = Menu::findOrFail($id);
        //删除数据
        $menu->delete();
        //跳转并提示信息
        return redirect()->route('menu.index')->with('success', '删除成功');
    }

}