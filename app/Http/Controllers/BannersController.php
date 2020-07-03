<?php

namespace App\Http\Controllers;

use App\Banner;
use Image;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function addBanner(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if(!empty($data['link'])) {
                $banner->link = $data['link'];
            }else {
            // If Banner Link is empty Show this error message
                return redirect()->back()->with('flash_message_error', 'Please add a link to your banner!');
            }

            $banner = new Banner;
            $banner->title = $data['title'];
            $banner->link = $data['link'];

            if(empty($data['status'])) {
                $status = 0;
            }else {
                $status = 1;
            }
            //Upload Image
            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banners/'.$filename;
                    //Resize Images
                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);
                    //Store image name in banners table
                    $banner->image = $filename;
                }
            }
            $banner->status = $status;
            $banner->save();
            // return redirect()->back()->with('flash_message_success', 'Product has been added successfully!');
            return redirect('/admin/add-banner')->with('flash_message_success', 'Banner has been added successfully!');
        }
        return view('admin.banners.add_banner');
    }

    public function editBanner(Request $request, $id=null)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if(empty($data['status'])) {
                $status = 0;
            }else {
                $status = 1;
            }
            if(empty($data['title'])) {
                $title = '';
            }
            if(empty($data['link'])) {
                $link = '';
            }
            //Upload Image
            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banners/'.$filename;
                    //Resize Images
                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);
                }
            }else if(!empty($data['current_image'])) {
                $filename = $data['current_image'];
            }else {
                $filename = '';
            }
            Banner::where('id',$id)->update(['status'=>$status, 'title' => $data['title'], 'link' => $data['link'], 'image'=> $filename]);
            return redirect()->back()->with('flash_message_success', 'Banner has been edited successfully!');
        }
        $bannerDetails = Banner::where('id', $id)->first();
        return view('admin.banners.edit_banner', compact('bannerDetails'));
    }

    public function viewBanners()
    {
        $banners = Banner::get();
        return view('admin.banners.view_banners', compact('banners'));
    }

     public function deleteBanner($id = null) {
        Banner::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Banner  has been deleted successfully!');
    }
}
