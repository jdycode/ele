<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/8/3
 * Time: 11:26
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /*
     * 展示
     */
    public function index()
    {
        //获取所有数据
        $roles = Role::all();
        //显示视图
        return view('admin.role.index', compact('roles'));
    }

    /*
     * 添加
     */
    public function add(Request $request)
    {
        //判断是否post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                //接收参数
                $data['name'] = $request->post('name'),
                $data['guard_name'] = 'admin',
            ]);

//            dd($request->post('role'));
            //创建角色
            $role = Role::create($data);
            //给角色添加权限
            $role->syncPermissions($request->post('role'));

            //跳转 提示信息
            return redirect()->route('role.index')->with('success', '添加成功');
        }
        //获取所有权限
        $pers = Permission::all();
       //显示视图
        return view('admin.role.add', compact('pers'));
    }

    /*
     * 编辑
     */
    public function edit(Request $request, $id)
    {
        //通过id找到当前数据
        $roles = Role::findOrFail($id);
        //判断是否post提交
        if ($request->isMethod('post')) {
            //验证
            $this->validate($request, [
                //接收参数
                $data['name'] = $request->post('name'),
                $data['guard_name'] = 'admin',
            ]);
//            dd($request->post('role'));
            //创建角色
            $roles->update($data);
            //给角色添加权限
            $roles->syncPermissions($request->post('role'));
            //跳转 提示信息
            return redirect()->route('role.index')->with('success', '修改成功');
        }
        //获取所有权限
        $pers = Permission::all();
        //显示视图
        return view('admin.role.edit', compact('pers', 'roles'));
    }

    /*
   * 删除
   */
    public function del($id)
    {
        $roles = Permission::findOrFail($id);
        //删除数据
        $roles->delete();
        //跳转 提示
        return redirect()->route('role.index')->with('success', '删除成功');
    }

}