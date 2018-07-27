<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/7/24
 * Time: 17:59
 */

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web')->except("login");
    }
    /*
     * 显示首页
     */
    public function show()
    {
        //得到所有数据
        $acts = Activity::orderBy('id','desc')->paginate(2);
        //显示列表
        return view('shop.activity.show', compact('acts'));
    }
}