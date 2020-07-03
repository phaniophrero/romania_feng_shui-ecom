<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Image;
use Session;
use App\User;
use App\Order;
use App\Banner;
use App\Coupon;
use App\Country;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\OrdersProduct;
use App\ProductsImage;
use App\DeliveryAddress;
use App\ProductsAttribute;
use Illuminate\Http\Request;
use App\Exports\productsExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    public function addProduct(Request $request)
    {
        if(Session::get('adminDetails')['products_full_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if(empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_error', 'Under Category is missing!');
            }
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];

            if(!empty($data['weight'])) {
                $product->weight = $data['weight'];
            }else {
                $product->weight = 0;
            }
            if(!empty($data['description'])) {
                $product->description = $data['description'];
            }else {
                $product->description = '';
            }

            if(!empty($data['used_for'])) {
                $product->used_for = $data['used_for'];
            }else {
                $product->used_for = '';
            }

            if(!empty($data['care'])) {
                $product->care = $data['care'];
            }else {
                $product->care = '';
            }
            if(empty($data['status'])) {
                $status = 0;
            }else {
                $status = 1;
            }
            if(empty($data['feature_item'])) {
                $feature_item = 0;
            }else {
                $feature_item = 1;
            }
            $product->price = $data['price'];
            // Upload Image
            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    //Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    //Store image name in products table
                    $product->image = $filename;
                }
            }
            // Upload Video
            if($request->hasFile('video')) {
                $video_tmp = $request->file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path,$video_name);
                $product->video = $video_name;
            }

            $product->feature_item = $feature_item;
            $product->status = $status;
            $product->save();
            // return redirect()->back()->with('flash_message_success', 'Product has been added successfully!');
            return redirect('/admin/view-products')->with('flash_message_success', 'Product has been added successfully!');
        }

        //Categories drop down start
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat) {
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value ='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories drop down ends

        $used_forArray = array('protection', 'success', 'health', 'love', 'learning');

        // $sizeArray = array('protection', 'success', 'health', 'love', 'learning');

        return view('admin.products.add_product', compact('categories_dropdown', 'used_forArray'));
    }

    public function editProduct(Request $request, $id = null) {

        if(Session::get('adminDetails')['products_edit_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            //Upload Image
            if($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    //Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                }
            }else if(!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else {
                $filename = '';
            }

            // Upload Video
            if($request->hasFile('video')) {
                $video_tmp = $request->file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path,$video_name);
                $videoName = $video_name;
            }else if(!empty($data['current_video'])){
                $videoName = $data['current_video'];
            }else {
                $videoName = '';
            }

            if(empty($data['description'])) {
                $data['description'] = '';
            }

            if(empty($data['care'])) {
                $data['care'] = '';
            }

            if(empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_error', 'Subcategory not selected!');
            }

            if(empty($data['status'])) {
                $status = 0;
            }else {
                $status = 1;
            }
            if(empty($data['feature_item'])) {
                $feature_item = 0;
            }else {
                $feature_item = 1;
            }

            if(!empty($data['used_for'])) {
                $used_for = $data['used_for'];
            }else {
                $used_for = '';
            }

            Product::where(['id' => $id])->update(['feature_item' => $feature_item, 'status' => $status,'category_id'=>$data['category_id'], 'product_name' => $data['product_name'], 'product_code' => $data['product_code'],'product_color' => $data['product_color'], 'description' => $data['description'], 'care' => $data['care'], 'price' => $data['price'], 'weight' => $data['weight'], 'image' => $filename,'video'=>$videoName, 'used_for'=>$used_for]);
            return redirect()->back()->with('flash_message_success', 'Product has been updated successfully!');
        }

        //Get Product Details
        $productDetails = Product::where(['id' => $id])->first();

        //Categories drop down start
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat) {
            if($cat->id == $productDetails->category_id) {
                $selected = "selected";
            }else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach($sub_categories as $sub_cat) {
                if($sub_cat->id == $productDetails->category_id) {
                $selected = "selected";
                }else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value ='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }//Categories drop down ends

        $used_forArray = array('protection', 'success', 'health', 'love', 'learning');

        return view('admin.products.edit_product', compact('productDetails', 'categories_dropdown','used_forArray'));
    }

    public function viewProducts() {
        if(Session::get('adminDetails')['products_view_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }
        $products = Product::orderBy('id', 'DESC')->get();
        foreach($products as $key => $val) {
            $category_name = Category::where(['id' => $val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products', compact('products'));
    }

    public function deleteProduct($id = null) {
        if(Session::get('adminDetails')['products_full_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        Product::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Product  has been deleted successfully!');
    }

    public function deleteProductImage($id)
    {
        if(Session::get('adminDetails')['products_full_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        //Get Product Image Name
        $productImage = Product::where(['id'=> $id])->first();

        //Get Product Image Paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        //Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }

        //Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }

        //Delete Image from Products table
        Product::where(['id' => $id])->update(['image' => '']);
        return redirect()->back()->with('flash_message_success', 'Product Image has been deleted successfully!');
    }

    public function deleteProductVideo($id)
    {
        if(Session::get('adminDetails')['products_full_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        // Get Video Name
        $productVideo = Product::select('video')->where('id', $id)->first();

        // Get Video Path
        $video_path = 'videos/';
        // Delete video if exists in videos folder
        if(file_exists($video_path.$productVideo->video)) {
            unlink($video_path.$productVideo->video);
        }
        // Delete Video from Products table
        Product::where('id',$id)->update(['video'=>'']);

        return redirect()->back()->with('flash_message_success', 'Product Video has been deleted successfully');
    }

    public function deleteAltImage($id = null)
    {
        if(Session::get('adminDetails')['products_full_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        //Get Product Image Name
        $productImage = ProductsImage::where(['id'=> $id])->first();

        //Get Product Image Paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        //Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        //Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }

        //Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }

        //Delete Image from Products table
        ProductsImage::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Product Alternate Image(s) has been deleted successfully!');
    }

    public function addAttributes(Request $request, $id = null) {
        if(Session::get('adminDetails')['products_edit_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        // $productDetails = json_decode(json_encode($productDetails));
        // echo "<pre>"; print_r($productDetails); die;

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach($data['sku'] as $key => $val){
                if(!empty($val)) {
                    //Prevent duplicate SKU Check
                    $attrCountSKU = ProductsAttribute::where('sku', $val)->count();
                    if($attrCountSKU > 0) {
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', 'SKU already exists! Please add another SKU.');
                    }

                    //Prevent duplicate Size Check
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSize > 0) {
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', '"'.$data['size'][$key].'" Size already exists for this product! Please add another Size.');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success', 'Product Attributes has been added successfully!');
        }
        return view('admin.products.add_attributes', compact('productDetails'));
    }

    public function editAttributes(Request $request, $id = null)
    {
        if(Session::get('adminDetails')['products_edit_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach($data['idAttr'] as $key => $attr) {
                ProductsAttribute::where(['id' => $data['idAttr'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
            }

            return redirect()->back()->with('flash_message_success', 'Products Attributes has been updated successfully!');
        }
    }

    public function addImages(Request $request, $id = null) {

        if(Session::get('adminDetails')['products_edit_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        if ($request->isMethod('post')) {
            //Add images
            $data = $request->all();
            if($request->hasFile('image')) {
                $files = $request->file('image');
                foreach($files as $file) {
                    //Upload Images after resize
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999). '.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$fileName;
                    $medium_image_path = 'images/backend_images/products/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/small/'.$fileName;
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);
                    $image->image = $fileName;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }

            }
            return redirect('admin/add-images/'.$id)->with('flash_message_success','Product Images has been added successfully!');
        }

        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        $productsImg = ProductsImage::where(['product_id'=>$id])->get();
        $productsImg = json_decode(json_encode($productsImg));
        // echo "<pre>"; print_r($productsImg); die;

        $productsImages = "";
        foreach($productsImg as $img) {
            $productsImages .="<tr>
                <td>". $img->id ."</td>
                <td>".$img->product_id."</td>
                <td><img width='150px' src='/images/backend_images/products/small/$img->image'></td>
                <td><a rel='$img->id' rel1='delete-alt-image' href='javascript:' class='deleteRecord btn btn-danger btn-mini' title='Delete Product Image'>Delete</a></td>
            </tr>";
        }

        return view('admin.products.add_images', compact('productDetails', 'productsImages'));
    }

    public function deleteAttribute($id = null) {
        if(Session::get('adminDetails')['products_full_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        ProductsAttribute::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success','Attribute has been deleted successfully!');
    }

    public function products($url = null) {
        //Show 404 page if Category does not exist
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if($categoryCount == 0){
            abort(404);
        }
        //Get all Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails = Category::where(['url' => $url])->first();
        if($categoryDetails->parent_id==0) {
            //If url is main category url
            $subCategories = Category::where(['parent_id' => $categoryDetails->id])->get();
            foreach($subCategories as $subcat) {
                $cat_ids[] = $subcat->id;
            }
            $productsAll = Product::whereIn('products.category_id', $cat_ids)->where('products.status', 1)->orderBy('products.id', 'Desc');
            $breadcrumb = "<a hreaf='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
        }else {
            //If url is sub category url
            $productsAll = Product::where(['products.category_id' => $categoryDetails->id])->where('products.status', 1)->orderBy('products.id', 'Desc');
            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
            $breadcrumb = "<a hreaf='/'>Home</a> / <a href='".$mainCategory->url."'>".$mainCategory->name."</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
        }

        if(!empty($_GET['color'])) {
            $colorArray = explode('-', $_GET['color']);
            $productsAll = $productsAll->whereIn('products.product_color', $colorArray);
        }

        if(!empty($_GET['used_for'])) {
            $used_forArray = explode('-', $_GET['used_for']);
            $productsAll = $productsAll->whereIn('products.used_for', $used_forArray);
        }

        if(!empty($_GET['size'])) {
            $sizeArray = explode('-', $_GET['size']);
            $productsAll = $productsAll->join('products_attributes','products_attributes.product_id','=','products.id')
            ->select('products.*', 'products_attributes.product_id', 'products_attributes.size')
            ->groupBy('products_attributes.product_id')
            ->whereIn('products_attributes.size', $sizeArray);
        }

        $productsAll = $productsAll->paginate(6);

        // $colorArray = array('Black', 'White','Blue', 'Brown','Green','Orange','Pink','Purple','Red','Yellow','Golden','Silver');
        $colorArray = Product::select('product_color')->groupBy('product_color')->get();
        $colorArray = array_flatten(json_decode(json_encode($colorArray), true));
        // echo "<pre>"; print_r($colorArray); die;

        // El are sleeveArray in loc de used_forArray
        $used_forArray = Product::select('used_for')->where('used_for', '!=', '')->groupBy('used_for')->get();
        $used_forArray = array_flatten(json_decode(json_encode($used_forArray), true));

        //El are si un patternArray , dar eu nu l-am facut video part #136

        $banners = Banner::where('status', '1')->get();

        $sizesArray = ProductsAttribute::select('size')->groupBy('size')->get();
        $sizesArray = array_flatten(json_decode(json_encode($sizesArray), true));

        $meta_title = $categoryDetails->meta_title;
        $meta_description = $categoryDetails->meta_description;
        $meta_keywords = $categoryDetails->meta_keywords;
        return view('products.listing',compact('categories','categoryDetails', 'productsAll','meta_title', 'meta_description', 'meta_keywords', 'url','colorArray', 'used_forArray', 'sizesArray','breadcrumb','banners'));
    }

    public function filter(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;

        $colorUrl = "";
        if(!empty($data['colorFilter'])) {
            foreach($data['colorFilter'] as $color) {
                if(empty($colorUrl)) {
                    $colorUrl = "&color=".$color;
                }else {
                    $colorUrl .= "-".$color;
                }
            }
        }

        $used_forUrl = "";
        if(!empty($data['used_forFilter'])) {
            foreach($data['used_forFilter'] as $used_for) {
                if(empty($used_forUrl)) {
                    $used_forUrl = "&used_for=".$used_for;
                }else {
                    $used_forUrl .= "-".$used_for;
                }
            }
        }

        $sizeUrl = "";
        if(!empty($data['sizeFilter'])) {
            foreach($data['sizeFilter'] as $size) {
                if(empty($sizeUrl)) {
                    $sizeUrl = "&size=".$size;
                }else {
                    $sizeUrl .= "-".$size;
                }
            }
        }

        $finalUrl = "products/".$data['url']."?".$colorUrl.$used_forUrl.$sizeUrl;
        return redirect::to($finalUrl);
    }

    public function searchProducts(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $categories = Category::with('categories')->where(['parent_id'=>0])->get();
            $search_product = $data['product'];
            // $productsAll = Product::where('product_name','like','%'.$search_product.'%')->orWhere('product_code', $search_product)->where('status', 1)->get();
            $productsAll = Product::where(function($query) use($search_product){
                $query->where('product_name', 'like', '%'.$search_product.'%')
                ->orWhere('product_code', 'like', '%'.$search_product.'%')
                ->orWhere('description', 'like', '%'.$search_product.'%')
                ->orWhere('product_color', 'like', '%'.$search_product.'%');
            })->where('status',1)->get();

            $breadcrumb = "<a href='/'>Home</a> / ".$search_product;

            return view('products.listing',compact('categories', 'search_product', 'productsAll', 'breadcrumb'));
        }
    }

    public function product($id = null) {

        //Show 404 Page if Product is disabled
        $productsCount = Product::where(['id' => $id, 'status' => 1])->count();
        if($productsCount == 0) {
            abort(404);
        }

        //Get Product Details
        $productDetails = Product::with('attributes')->where('id',$id)->first();
        $productDetails = json_decode(json_encode($productDetails));
        // echo "<pre>"; print_r($productDetails); die;

        $relatedProducts = Product::where('id','!=', $id)->where(['category_id' => $productDetails->category_id])->get();
        // $relatedProducts = json_decode(json_encode($relatedProducts));
        // foreach($relatedProducts->chunk(3) as $chunk) {
        //     foreach($chunk as $item) {
        //         echo $item; echo "<br>";
        //     }
        //     echo "<br><br><br>";
        // }
        // die;
        // echo "<pre>"; print_r($relatedProducts); die;

        //Get all Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        //Get Product Alternate Images
        $productAltImages = ProductsImage::where('product_id', $id)->get();
        // $productAltImages = json_decode(json_encode($productAltImages));
        // echo "<pre>"; print_r($productAltImages); die;


        $categoryDetails = Category::where('id', $productDetails->category_id)->first();
        if($categoryDetails->parent_id==0) {
            //If url is main category url
            $breadcrumb = "<a hreaf='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
            // $productsAll = json_decode(json_encode($productsAll));
            // echo "<pre>"; print_r($productsAll);
        }else {
            //If url is sub category url
            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
            $breadcrumb = "<a style='color: #333;' hreaf='/'>Home</a> / <a style='color: #333;' href='/products/".$mainCategory->url."'>".$mainCategory->name."</a> / <a style='color: #333;' href='/products/".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
        }


        $total_stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $meta_title = $productDetails->product_name;
        $meta_description = $productDetails->description;
        $meta_keywords = $productDetails->product_name;
        return view('products.detail',compact('productDetails', 'categories', 'productAltImages', 'total_stock', 'relatedProducts', 'meta_title', 'meta_description', 'meta_keywords', 'breadcrumb'));
    }

    public function getProductPrice(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $proArr = explode("-", $data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0],'size' => $proArr[1]])->first();
        $getCurrencyRates = Product::getCurrencyRates($proAttr->price);
        echo $proAttr->price."-".$getCurrencyRates['USD_Rate']."-".$getCurrencyRates['EUR_Rate']."-".$getCurrencyRates['GBP_Rate'];
        echo "#";
        echo $proAttr->stock;
    }

    public function addtocart(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;

        if(!empty($data['wishListButton']) && $data['wishListButton'] == "Wish List") {
            // echo "Wish list is selecte!"; die;

            // Check if User is logged in
            if(!Auth::check()){
                return redirect()->back()->with('flash_message_error', 'Please login to add product to your Wish List!');
            }
            // Check if Size is Selected
            if(empty($data['size'])) {
                return redirect()->back()->with('flash_message_error', 'Please select size to add product to your Wish List!');
            }
            // Get Product Size
            $sizeIDArr = explode("-",$data['size']);
            $product_size = $sizeIDArr[1];

            // Get Product Price
            $proPrice = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$product_size])->first();
            $product_price = $proPrice->price;

            // Get User Emial/Username
            $user_email = Auth::user()->email;
            // Set Quantity as 1
            $quantity = 1;
            // Get Current Date
            $created_at = Carbon::now();
            //Wish List Count
            $wishListCount = DB::table('wish_list')->where(['user_email'=>$user_email, 'product_id'=>$data['product_id'], 'product_color'=>$data['product_color'], 'size'=>$product_size])->count();
            if($wishListCount > 0) {
                return redirect()->back()->with('flash_message_error', 'Product already exist in Wish List!');
            } else {
                // Insert Product in Wish List
                DB::table('wish_list')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'price'=>$product_price, 'size'=>$product_size, 'quantity'=>$quantity,'user_email'=>$user_email,'created_at'=>$created_at]);
                return redirect()->back()->with('flash_message_success', 'Product has been added to your Wish List!');
            }

        } else {
            // If product added from Wish List
            if(!empty($data['cartButton']) && $data['cartButton'] == "Add to Cart") {
                $data['quantity'] = 1;
            }
            // If you try to add product without choosing a size
            // if(empty($data['size'])) {
            //     return redirect()->back()->with('flash_message_error', 'Please select a size for your product!');
            // }
            // Check Product Stock is available or not
            $product_size = explode("-",$data['size']);
            $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$product_size[1]])->first();

            if($getProductStock->stock < $data['quantity']) {
                return redirect()->back()->with('flash_message_error', 'Required quantity is not available!');
            }
            if(empty(Auth::user()->email)) {
                $data['user_email'] = '';
            }else {
                $data['user_email'] = Auth::user()->email;
            }
            $session_id = Session::get('session_id');
            if(empty($session_id)) {
                $session_id = str_random(40);
                Session::put('session_id', $session_id);
            }

            $sizeIDArr = explode("-",$data['size']);
            $product_size = $sizeIDArr[1];

            if(empty(Auth::check())) {
                $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],'product_color'=>$data['product_color'],'size'=>$product_size,'session_id' => $session_id])->count();
                if($countProducts > 0) {
                return redirect()->back()->with('flash_message_error', 'Product already exists in your Cart!');
                }
            }else {
                $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],'product_color'=>$data['product_color'],'size'=>$product_size,'user_email' => $data['user_email']])->count();
                if($countProducts > 0) {
                    return redirect()->back()->with('flash_message_error', 'Product already exists in your Cart!');
                }
            }

            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$product_size])->first();

            DB::table('cart')->insert(['product_id' => $data['product_id'],'product_name' => $data['product_name'], 'product_code'=>$getSKU['sku'],'product_color'=>$data['product_color'],'price'=>$data['price'],'size'=>$product_size, 'quantity'=>$data['quantity'], 'user_email'=>$data['user_email'],'session_id' => $session_id]);

            return redirect('cart')->with('flash_message_success', 'Product has been added to your Cart!');
        }
    }

    public function cart()
    {
        if(Auth::check()) {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        // echo "<pre>"; print_r($userCart);
        $meta_title = "Shopping Cart | Romania Feng Shui";
        $meta_description = "View Shopping Cart of Romania Feng Shui Online Store";
        $meta_keywords = "shopping cart, romania feng shui";
        return view('products.cart', compact('userCart', 'meta_title','meta_description', 'meta_keywords'));
    }

    public function wishList()
    {
        if(Auth::check()) {
            $user_email = Auth::user()->email;
            $userWishList = DB::table('wish_list')->where('user_email',$user_email)->get();
            foreach($userWishList as $key => $product){
                $productDetails = Product::where('id', $product->product_id)->first();
                $userWishList[$key]->image = $productDetails->image;
            }
        }else {
            $userWishList = array();
        }
        $meta_title = "Wish List | Romania Feng Shui";
        $meta_description = "View Wish List of Romania Feng Shui Online Store";
        $meta_keywords = "wish list, romania feng shui";
        return view('products.wish_list', compact('userWishList', 'meta_title','meta_description', 'meta_keywords'));
    }

    public function updateCartQuantity($id = null, $quantity = null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $getCartDetails = DB::table('cart')->where('id', $id)->first();
        $getAttributeStock = ProductsAttribute::where('sku', $getCartDetails->product_code)->first();
        $updated_quantity =$getCartDetails->quantity+$quantity;
        if($getAttributeStock->stock >= $updated_quantity) {
            DB::table('cart')->where('id',$id)->increment('quantity', $quantity);
            return redirect('cart')->with('flash_message_success', 'Product has been updated successfully!');
        } else {
            return redirect('cart')->with('flash_message_error', 'Required Product quantity is not available!');
        }
    }

    public function deleteCartProduct($id = null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id', $id)->delete();
        return redirect('cart')->with('flash_message_success', 'Product has been deleted from your Cart!');
    }

    public function applyCoupon(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
        if($couponCount == 0) {
            return redirect()->back()->with('flash_message_error', 'This coupon does not exist!');
        }else {
            // with perform other checks like Active/Inactive, Expiry date..

            //Get Coupon Details
            $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first();

            //If coupon is Inactive
            if($couponDetails->status == 0) {
                return redirect()->back()->with('flash_message_error', 'This coupon is not active!');
            }

            //If coupon is Expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date) {
                return redirect()->back()->with('flash_message_error', 'This coupon is expired!');
            }
            //Coupon is Valid for Discount

            //Get Cart Total Amount
            $session_id = Session::get('session_id');

            if(Auth::check()) {
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }else {
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }

            $total_amount = 0;
            foreach($userCart as $item) {
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            //Check if amount type is Fixed or Percentage
            if($couponDetails->amount_type == "Fixed") {
                $couponAmount = $couponDetails->amount;
            }else {
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            //Add Coupon Code & Amount in Session
            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $data['coupon_code']);

            return redirect()->back()->with('flash_message_success', 'Coupon code successfully applied!');
        }
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        // $shippingDetails = array();
        // Check if Shipping Address exists
        $shippingCount = DeliveryAddress::where('user_id', $user_id)->count();
        $shippingDetails = array();
        if($shippingCount > 0) {
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        // Update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // Return to Checkout page if any of the field if empty
            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || empty($data['billing_state']) || empty($data['billing_country']) || empty($data['billing_zipcode']) || empty($data['billing_mobile']) || empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country']) || empty($data['shipping_zipcode']) || empty($data['shipping_mobile'])) {
                return redirect()->back()->with('flash_message_error', 'Please fill all fields to Checkout !');
            }
            // Update User details
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'], 'city'=>$data['billing_city'],'state'=>$data['billing_state'],'country'=>$data['billing_country'], 'zipcode'=>$data['billing_zipcode'],'mobile'=>$data['billing_mobile']]);

            if($shippingCount > 0) {
                // Update Shipping Address
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'], 'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'], 'zipcode'=>$data['shipping_zipcode'],'mobile'=>$data['shipping_mobile']]);
            }else {
                // Add New Shipping Address
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->zipcode = $data['shipping_zipcode'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }

            $zipcodeCount = DB::table('zipcodes')->where('zipcode', $data['shipping_zipcode'])->count();
            if($zipcodeCount == 0) {
                return redirect()->back()->with('flash_message_error','Your location is not available for delivery. Please enter another location.');
            }

            return redirect()->action('ProductsController@orderReview');
        }

        $meta_title = "Checkout | Romania Feng Shui";
        return view('products.checkout', compact('userDetails', 'countries', 'shippingDetails', 'meta_title'));
    }

    public function orderReview()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        $total_weight = 0;
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
            $total_weight = $total_weight + $productDetails->weight;
        }
        // echo "<pre>"; print_r($userCart); die;
        $codzipcodeCount = DB::table('cod_zipcodes')->where('zipcode', $shippingDetails->zipcode)->count();
        $prepaidzipcodeCount = DB::table('prepaid_zipcodes')->where('zipcode', $shippingDetails->zipcode)->count();

        // Fetching Shipping Charges
        $shippingCharges = Product::getShippingCharges($total_weight, $shippingDetails->country);
        Session::put('ShippingCharges', $shippingCharges);

        $meta_title = "Order Review | Romania Feng Shui";
        return view('orders.order_review', compact('userDetails', 'shippingDetails', 'userCart', 'meta_title', 'codzipcodeCount', 'prepaidzipcodeCount', 'shippingCharges'));
    }

    public function placeOrder(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // Prevent Out of Stock Products from ordernig
            $userCart = DB::table('cart')->where('user_email', $user_email)->get();
            foreach($userCart as $cart) {

                $getAttributeCount = Product::getAttributeCount($cart->product_id,$cart->size);
                if($getAttributeCount == 0){
                    Product::deleteCartProduct($cart->product_id, $user_email);
                    return redirect('/cart')->with('flash_message_error', 'One of the products is not available. Please try again!');
                }

                $product_stock = Product::getProductStock($cart->product_id, $cart->size);
                if($product_stock == 0){
                    Product::deleteCartProduct($cart->product_id, $user_email);
                    return redirect('/cart')->with('flash_message_error', 'This product has been sold out! Please choose another product.');
                }
                if($cart->quantity > $product_stock) {
                    return redirect('/cart')->with('flash_message_error', 'Reduce product stock and try again!');
                }
                $product_status = Product::getProductStatus($cart->product_id);
                if($product_status ==0) {
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error', 'This product has been disabled. Please choose another product!');
                }

                $getCategoryId = Product::select('category_id')->where('id',$cart->product_id)->first();
                $category_status = Product::getCategoryStatus($getCategoryId->category_id);
                if($category_status == 0) {
                    Product::deleteCartProduct($cart->product_id,$user_email);
                    return redirect('/cart')->with('flash_message_error', 'This product category has been disabled. Please choose another product category!');
                }

            }
            // Get Shipping Address of User
            $shippingDetails = DeliveryAddress::where(['user_email' => $user_email])->first();
            // echo "<pre>"; print_r($shippingDetails); die;

            $zipcodeCount = DB::table('zipcodes')->where('zipcode', $shippingDetails->zipcode)->count();
            if($zipcodeCount == 0) {
                return redirect()->back()->with('flash_message_error','Your location is not available for delivery. Please enter another location.');
            }

            if(empty(Session::get('CouponCode'))) {
                $coupon_code = '';
            }else {
                $coupon_code = Session::get('CouponCode');
            }
            if(empty(Session::get('CouponAmount'))) {
                $coupon_amount = '';
            }else {
                $coupon_amount = Session::get('CouponAmount');
            }

            // Fetching Shipping Charges
            // $shippingCharges = Product::getShippingCharges($shippingDetails->country);

            $grand_total = Product::getGrandTotal();

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->zipcode = $shippingDetails->zipcode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->shipping_charges = Session::get('ShippingCharges');
            $order->grand_total = $grand_total;
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();
            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro) {
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_size = $pro->size;
                $product_price = ProductsAttribute::getProductPrice($pro->product_id,$pro->size);
                $cartPro->product_price = $product_price;
                $cartPro->product_qty = $pro->quantity;
                $cartPro->save();

                // Reduce Stock Scripts Start
                $getProductStock = ProductsAttribute::where('sku', $pro->product_code)->first();
                // echo "Original Stock:"; $getProductStock->stock;
                // echo "Stock to reduce:"; $pro->quantity;
                $newStock = $getProductStock->stock - $pro->quantity;
                if($newStock < 0) {
                    $newStock = 0;
                }
                ProductsAttribute::where('sku',$pro->product_code)->update(['stock'=> $newStock]);
                // Reduce Stock Scripts End
            }

            Session::put('order_id', $order_id);
            Session::put('grand_total', $grand_total);

            if($data['payment_method'] == "COD") {

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails), true);
                // echo "<pre>"; print_r($productDetails); die;
                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails), true);
                // echo "<pre>"; print_r($userDetails); die;
                /* Code for Order Email Start */
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails
                ];
                Mail::send('emails.order', $messageData, function($message) use($email){
                    $message->to($email)->subject('Order Placed - Romania Feng Shui Store');
                });
                /* Code for Order Email End */
                // COD - Redirect user to thanks page after saving order
                return redirect('/thanks');
            }else if($data['payment_method'] == "Stripe"){
                // Payumoney - Redirect user to payumoney page after saving order
                return redirect('/payment-method/card');
            }else{
                // Paypal - Redirect user to paypal page after saving order
                return redirect('/paypal');
            }

        }
    }

    public function thanks(Request $request)
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('orders.thanks');
    }

    public function thanksPaypal()
    {
        return view('orders.thanks_paypal');
    }

    public function paypal(Request $request)
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email', $user_email)->delete();
        return view('orders.paypal');
    }

    public function cancelPaypal()
    {
        return view('orders.cancel_paypal');
    }

    public function ipnPaypal(Request $request)
    {
        $data = $request->all();
        if($data['payment_status'] == "Completed") {
            // We will send email to user/admin
            // Update Order status to Payment Captured

            // Get Order ID
            $order_id = Session::get('order_id');
            // Update Order
            Order::where('id',$order_id)->update(['order_status'=>'Payment Captured']);
            $productDetails = Order::with('orders')->where('id',$order_id)->first();
            $productDetails = json_decode(json_encode($productDetails), true);
            // echo "<pre>"; print_r($productDetails); die;

            $user_id = $productDetails['user_id'];
            $user_email = $productDetails['user_email'];
            $name = $productDetails['name'];

            $userDetails = User::where('id',$user_id)->first();
            $userDetails = json_decode(json_encode($userDetails), true);
            // echo "<pre>"; print_r($userDetails); die;
            /* Code for Order Email Start */
            $email = $user_email;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'order_id' => $order_id,
                'productDetails' => $productDetails,
                'userDetails' => $userDetails
            ];
            Mail::send('emails.order', $messageData, function($message) use($email){
                $message->to($email)->subject('Order Placed - Romania Feng Shui Store');
            });
            /* Code for Order Email End */

            // Empty Cart
            DB::table('cart')->where('user_email', $user_email)->delete();
        }
    }

    public function userOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id', 'DESC')->get();

        return view('orders.user_orders', compact('orders'));
    }

    public function userOrdersDetails($order_id)
    {
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        return view('orders.user_order_details', compact('orderDetails'));
    }

    public function viewOrders()
    {
        if(Session::get('adminDetails')['orders_view_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        $orders = Order::with('orders')->orderBy('id','DESC')->get();
        $orders = json_decode(json_encode($orders));
        // echo "<pre>"; print_r($orders); die;
        return view('admin.orders.view_orders', compact('orders'));
    }

    public function viewOrderDetails($order_id)
    {
        if(Session::get('adminDetails')['orders_view_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id', $user_id)->first();
        // $userDetails = json_decode(json_encode($userDetails));
        // echo "<pre>"; print_r($userDetails); die;
        return view('admin.orders.order_details',compact('orderDetails', 'userDetails'));
    }

    public function viewOrderInvoice($order_id)
    {
        if(Session::get('adminDetails')['orders_view_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id', $user_id)->first();
        // $userDetails = json_decode(json_encode($userDetails));
        // echo "<pre>"; print_r($userDetails); die;
        return view('admin.orders.order_invoice',compact('orderDetails', 'userDetails'));
    }

    public function viewPDFInvoice($order_id) {
        if(Session::get('adminDetails')['orders_view_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        // echo "<pre>"; print_r($orderDetails); die;
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id', $user_id)->first();
        // $userDetails = json_decode(json_encode($userDetails));
        // echo "<pre>"; print_r($userDetails); die;

        $output = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Example 1</title>
            <style>
            .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }
        a {
        color: #5D6975;
        text-decoration: underline;
        }
        body {
        position: relative;
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: Arial;
        }
        header {
        padding: 10px 0;
        margin-bottom: 30px;
        }
        #logo {
        text-align: center;
        margin-bottom: 10px;
        }
        #logo img {
        width: 90px;
        }
        h1 {
        border-top: 1px solid  #5D6975;
        border-bottom: 1px solid  #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
        }
        #project {
        float: left;
        }
        #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
        }
        #company {
        float: right;
        text-align: right;
        }
        #project div,
        #company div {
        white-space: nowrap;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }
        table tr:nth-child(2n-1) td {
        background: #F5F5F5;
        }
        table th,
        table td {
        text-align: center;
        }
        table th {
        padding: 5px 20px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
        }
        table .service,
        table .desc {
        text-align: left;
        }
        table td {
        padding: 20px;
        text-align: right;
        }
        table td.service,
        table td.desc {
        vertical-align: top;
        }
        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1.2em;
        }
        table td.grand {
        border-top: 1px solid #5D6975;;
        }
        #notices .notice {
        color: #5D6975;
        font-size: 1.2em;
        }
        footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 8px 0;
        text-align: center;
        }
        </style>
        </head>
        <body>
        <header class="clearfix">
      <div id="logo">
        <img src="images/logo/logo.png">
      </div>
      <h1>INVOICE '.$orderDetails->id.'</h1>
      <div id="project" class="clearfix">
        <div><span>Order ID</span> '.$orderDetails->id.'</div>
        <div><span>Order Date</span> '.$orderDetails->created_at.'</div>
        <div><span>Order Amount</span> '.$orderDetails->grand_total.'</div>
        <div><span>Order Status</span> '.$orderDetails->order_status.'</div>
        <div><span>Payment Method</span> '.$orderDetails->payment_method.'</div>
      </div>
        <div id="project" style="float:right;">
        <div><strong>Shipping Address</strong></div>
        <div>'.$orderDetails->name.'</div>
        <div>'.$orderDetails->address.'</div>
        <div>'.$orderDetails->city.', '.$orderDetails->state.'</div>
        <div>'.$orderDetails->zipcode.', '.$orderDetails->country.'</div>
        <div>'.$orderDetails->mobile.'</div>
        </div>
        </header>
        <main>
        <table>
        <thead>
            <tr>
                <td style="width:18%;"><strong>Product Code</strong></td>
                <td style="width:18%;" class="text-center"><strong>Size</strong></td>
                <td style="width:18%;" class="text-center"><strong>Color</strong></td>
                <td style="width:18%;" class="text-center"><strong>Price</strong></td>
                <td style="width:18%;" class="text-center"><strong>Qty</strong></td>
                <td style="width:18%;" class="text-right"><strong>Totals</strong></td>
            </tr>
        </thead>
        <tbody>';
         $Subtotal = 0;
            foreach ($orderDetails->orders as $pro) {
            $output .='<tr>
                <td class="text-left">'.$pro->product_code.'</td>
                <td class="text-center">'.$pro->product_size.'</td>
                <td class="text-center">'.$pro->product_color.'</td>
                <td class="text-center">RON '.$pro->product_price.'</td>
                <td class="text-center">'.$pro->product_qty.'</td>
                <td class="text-right">RON '.$pro->product_price * $pro->product_qty.'</td>
            </tr>';
            $Subtotal = $Subtotal + ($pro->product_price * $pro->product_qty);
            }
        $output .='<tr>
            <td colspan="5">Subtotal</td>
            <td class="total">RON '.$Subtotal.'</td>
          </tr>
          <tr>
            <td colspan="5">Shipping Charges</td>
            <td class="total">RON '.$orderDetails->shipping_charges.'</td>
          </tr>
          <tr>
            <td colspan="5">Coupon Discount</td>
            <td class="total">RON '.$orderDetails->coupon_amount.'</td>
          </tr>
          <tr>
            <td colspan="5" class="grand total">Total</td>
            <td class="grand total">RON '.$orderDetails->grand_total.'</td>
          </tr>
        </tbody>
      </table>
        </main>
        <footer>
      Invoice was created on a computer and is valid without the signature and seal.
        </footer>
        </body>
        </html>';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

    }

    public function updateOrderStatus(Request $request)
    {
        if(Session::get('adminDetails')['orders_edit_access'] == 0) {
            return  redirect('/admin/dashboard')->with('flash_message_error', 'You have no access to this page!');
        }

        if($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success', 'Order Status has been successfully updated !');
        }
    }

    public function checkZipcode(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            echo $zipcodeCount = DB::table('zipcodes')->where('zipcode',$data['zipcode'])->count();
        }
    }

    public function exportProducts()
    {
        return Excel::download(new productsExport, 'products.xlsx');
    }

    public function deleteWishListProduct($id)
    {
        DB::table('wish_list')->where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success', 'Product has been deleted from your Wish List!');
    }

    public function viewOrdersCharts()
    {
        $current_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_orders = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();

        return view('admin.orders.view_orders_charts', compact('current_month_orders', 'last_month_orders', 'last_to_last_month_orders'));
    }
}
