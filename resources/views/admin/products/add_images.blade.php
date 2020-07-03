@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product Images</a> </div>
        <h1>Products Images</h1>
        @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">&#215;</button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
        @endif
        @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">&#215;</button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
        @endif
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Add Product Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post"
                            action="{{ url('/admin/add-images/'.$productDetails->id) }}" name="add_images"
                            id="add_images">
                            {{ csrf_field() }}

                            <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <label class="control-label"
                                    style="cursor: default;"><strong>{{ $productDetails->product_name }}</strong></label>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Product Code</label>
                                <label class="control-label"
                                    style="cursor: default;"><strong>{{ $productDetails->product_code }}</strong></label>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Alternate Image(s)</label>
                                <div class="controls">
                                    <input type="file" name="image[]" id="image" multiple="multiple">
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" value="Add Images" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>View Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Image ID</th>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $productsImages; ?>
                                {{-- @foreach($productsImg as $img)
                                                                <tr>
                                                                    <td>{{ $img->id }}</td>
                                <td>{{ $img->product_id }}</td>
                                <td><img src="{{ asset('images/backend_images/products/small'.$img->image) }}" alt="">
                                </td>
                                <td>Delete</td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection