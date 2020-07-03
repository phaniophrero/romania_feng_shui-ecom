<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->input();
            $adminCount = Admin::where(['username'=> $data['username'], 'password'=>md5($data['password']),'status'=>1])->count();
            if($adminCount > 0) {
                // echo "Success primo"; die;
                Session::put('adminSession', $data['username']);
                return redirect('/admin/dashboard');
            } else {
                // echo "Failed primo, no bueno"; die;
                return redirect('/admin')->with('flash_message_error', 'Invalid Username or Password');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard() {
        // if(Session::has('adminSession')) {
        //     //Perform all dashboard tasks
        // }else {
        //     return redirect('/admin')->with('flash_message_error', 'Please login to access this page');
        // }
        return view('admin.dashboard');
    }

    public function settings() {
        $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();
        // echo "<pre>"; print_r($adminDetails); die;
        return view('admin.settings', compact('adminDetails'));
    }

    public function checkPassword(Request $request){
        $data = $request->all();
        $adminCount = Admin::where(['username'=> Session::get('adminSession'), 'password'=>md5($data['current_pwd'])])->count();
        if($adminCount == 1) {
            echo"true"; die;
        }else {
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<prev>"; print_r($data); die;
            $adminCount = Admin::where(['username'=> Session::get('adminSession'), 'password'=>md5($data['current_pwd'])])->count();
            if($adminCount == 1) {
            $password = md5($data['new_pwd']);
            Admin::where('username', Session::get('adminSession'))->update(['password' => $password]);
            return redirect('/admin/settings')->with('flash_message_success', 'Password updated Successfully!');
            }else {
                return redirect('/admin/settings')->with('flash_message_error', 'Incorrect Current Password!');

            }
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out Successfully');
    }

    public function viewAdmins()
    {
        $admins = Admin::get();
        // $admins = json_decode(json_encode($admins));
        // echo "<pre>"; print_r($admins); die;
        return view('admin.admins.view_admins', compact('admins'));
    }

    public function addAdmin(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $adminCount = Admin::where('username',$data['username'])->count();
            if($adminCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Admin already exists!');
            } else {
                if(empty($data['status'])){
                        $data['status'] = 0;
                    }
                if($data['type'] == "Admin") {
                    $admin = new Admin;
                    $admin->username = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->status = $data['status'];
                    $admin->save();
                    return redirect()->back()->with('flash_message_success', 'Admin added successfully!');
                } else if($data['type'] == "Sub Admin") {
                    // Categories access
                    if(empty($data['categories_view_access'])){
                        $data['categories_view_access'] = 0;
                    }
                    if(empty($data['categories_edit_access'])){
                        $data['categories_edit_access'] = 0;
                    }
                    if(empty($data['categories_full_access'])){
                        $data['categories_full_access'] = 0;
                    } else {
                        if($data['categories_full_access'] == 1) {
                            $data['categories_view_access'] = 1;
                            $data['categories_edit_access'] = 1;
                        }
                    }
                    // Products access
                    if(empty($data['products_view_access'])){
                        $data['products_view_access'] = 0;
                    }
                    if(empty($data['products_edit_access'])){
                        $data['products_edit_access'] = 0;
                    }
                    if(empty($data['products_full_access'])){
                        $data['products_full_access'] = 0;
                    }else {
                        if($data['products_full_access'] == 1) {
                            $data['products_view_access'] = 1;
                            $data['products_edit_access'] = 1;
                        }
                    }
                    // Orders access
                    if(empty($data['orders_view_access'])){
                        $data['orders_view_access'] = 0;
                    }
                    if(empty($data['orders_edit_access'])){
                        $data['orders_edit_access'] = 0;
                    }
                    if(empty($data['orders_full_access'])){
                        $data['orders_full_access'] = 0;
                    }else {
                        if($data['orders_full_access'] == 1) {
                            $data['orders_view_access'] = 1;
                            $data['orders_edit_access'] = 1;
                        }
                    }
                    // Users access
                    if(empty($data['users_view_access'])){
                        $data['users_view_access'] = 0;
                    }
                    if(empty($data['users_edit_access'])){
                        $data['users_edit_access'] = 0;
                    }
                    if(empty($data['users_full_access'])){
                        $data['users_full_access'] = 0;
                    }else {
                        if($data['users_full_access'] == 1) {
                            $data['users_view_access'] = 1;
                            $data['users_edit_access'] = 1;
                        }
                    }

                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->status = $data['status'];
                    $admin->categories_view_access = $data['categories_view_access'];
                    $admin->categories_edit_access = $data['categories_edit_access'];
                    $admin->categories_full_access = $data['categories_full_access'];
                    $admin->products_view_access = $data['products_view_access'];
                    $admin->products_edit_access = $data['products_edit_access'];
                    $admin->products_full_access = $data['products_full_access'];
                    $admin->orders_view_access = $data['orders_view_access'];
                    $admin->orders_edit_access = $data['orders_edit_access'];
                    $admin->orders_full_access = $data['orders_full_access'];
                    $admin->users_view_access = $data['users_view_access'];
                    $admin->users_edit_access = $data['users_edit_access'];
                    $admin->users_full_access = $data['users_full_access'];
                    $admin->save();
                    return redirect()->back()->with('flash_message_success', 'Sub Admin added successfully!');
                }
            }
        }
        return view('admin.admins.add_admin');
    }

    public function editAdmin(Request $request, $id)
    {
        $adminDetails = Admin::where('id', $id)->first();
        // $adminDetails = json_decode(json_encode($adminDetails));
        // echo "<pre>"; print_r($adminDetails); die;
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if(empty($data['status'])){
                        $data['status'] = 0;
                    }
                if($data['type'] == "Admin") {
                    Admin::where('username', $data['username'])->update(['password'=>md5($data['password']), 'status' => $data['status']]);
                    return redirect()->back()->with('flash_message_success', 'Admin updated successfully!');

                } else if($data['type'] == "Sub Admin") {
                    // Categories Access
                    if(empty($data['categories_view_access'])){
                        $data['categories_view_access'] = 0;
                    }
                    if(empty($data['categories_edit_access'])){
                        $data['categories_edit_access'] = 0;
                    }
                    if(empty($data['categories_full_access'])){
                        $data['categories_full_access'] = 0;
                    } else {
                        if($data['categories_full_access'] == 1) {
                            $data['categories_view_access'] = 1;
                            $data['categories_edit_access'] = 1;
                        }
                    }
                    // Products Access
                    if(empty($data['products_view_access'])){
                        $data['products_view_access'] = 0;
                    }
                    if(empty($data['products_edit_access'])){
                        $data['products_edit_access'] = 0;
                    }
                    if(empty($data['products_full_access'])){
                        $data['products_full_access'] = 0;
                    }else {
                        if($data['products_full_access'] == 1) {
                            $data['products_view_access'] = 1;
                            $data['products_edit_access'] = 1;
                        }
                    }
                    // Orders Access
                    if(empty($data['orders_view_access'])){
                        $data['orders_view_access'] = 0;
                    }
                    if(empty($data['orders_edit_access'])){
                        $data['orders_edit_access'] = 0;
                    }
                    if(empty($data['orders_full_access'])){
                        $data['orders_full_access'] = 0;
                    }else {
                        if($data['orders_full_access'] == 1) {
                            $data['orders_view_access'] = 1;
                            $data['orders_edit_access'] = 1;
                        }
                    }
                    // Users Access
                    if(empty($data['users_view_access'])){
                        $data['users_view_access'] = 0;
                    }
                    if(empty($data['users_edit_access'])){
                        $data['users_edit_access'] = 0;
                    }
                    if(empty($data['users_full_access'])){
                        $data['users_full_access'] = 0;
                    }else {
                        if($data['users_full_access'] == 1) {
                            $data['users_view_access'] = 1;
                            $data['users_edit_access'] = 1;
                        }
                    }
                    Admin::where('username', $data['username'])->update(['password'=>md5($data['password']), 'status' => $data['status'], 'categories_view_access' => $data['categories_view_access'],'categories_edit_access' => $data['categories_edit_access'],'categories_full_access' => $data['categories_full_access'], 'products_view_access' => $data['products_view_access'],'products_edit_access' => $data['products_edit_access'],'products_full_access' => $data['products_full_access'], 'orders_view_access' => $data['orders_view_access'],'orders_edit_access' => $data['orders_edit_access'],'orders_full_access' => $data['orders_full_access'], 'users_view_access' => $data['users_view_access'],'users_edit_access' => $data['users_edit_access'],'users_full_access' => $data['users_full_access']]);
                    return redirect()->back()->with('flash_message_success', 'Sub Admin updated successfully!');
                }
        }

        return view('admin.admins.edit_admin', compact('adminDetails'));
    }
}
