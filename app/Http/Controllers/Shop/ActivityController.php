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
    public function show(Request $request)
    {
        $time =time();
        $time = date('Y-m-d',$time );
        $query=Activity::orderBy('id');
        if ($request->input('time') == -1) {

            $query = $query->where("end_time", "<", $time);
        }
        if ($request->input('time') == 1) {

            $query = $query->where("start_time", ">", $time);
        }
        if ($request->input('time') == 0) {

            $query =  $query->where("start_time", "<=", $time)->where('end_time','>=',$time);
        }
        //得到所有数据
        $acts =$query->paginate(3);
        //显示列表
        return view('shop.activity.show', compact('acts'));
    }



}