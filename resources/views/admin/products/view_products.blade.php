@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a> <a href="#">Products</a> <a href="#" class="current">View Products</a> </div>
        <h1>Products</h1>
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
    <div style="margin-left: 20px;">
        <a href="{{ url('/admin/export-products') }}" class="btn btn-primary btn-mini">Export</a>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>View Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Product Color</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Feature Item</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr class="gradeX">
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->category_id }}</td>
                                    <td>{{ $product->category_name }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_code }}</td>
                                    <td>{{ $product->product_color }}</td>
                                    <td>USD {{ $product->price }}</td>
                                    <td>
                                        @if (!empty($product->image))
                                        <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}"
                                            style="width:60px">
                                        @endif
                                    </td>
                                    <td>@if($product->feature_item == 1) Yes @else No @endif</td>
                                    <td class="center">
                                        @if(Session::get('adminDetails')['products_view_access'] == 1)
                                        <a href="#myModal{{ $product->id }}" data-toggle="modal"
                                            class="btn btn-success btn-mini" title="View Product">View</a>
                                        @endif
                                        @if(Session::get('adminDetails')['products_edit_access'] == 1)
                                        <a href="{{ url('/admin/edit-product/' . $product->id) }}"
                                            class="btn btn-primary btn-mini" title="Edit Product">Edit</a>
                                        @endif
                                        @if(Session::get('adminDetails')['products_edit_access'] == 1)
                                        <a href="{{ url('/admin/add-attributes/' . $product->id) }}"
                                            class="btn btn-success btn-mini" title="Add Attributes">Add</a>
                                        <a href="{{ url('/admin/add-images/' . $product->id) }}"
                                            class="btn btn-info btn-mini" title="Add Images">Add</a>
                                        @endif
                                        @if(Session::get('adminDetails')['products_full_access'] == 1)
                                        <a rel="{{ $product->id }}" rel1="delete-product"
                                            <?php /* href="{{ url('/admin/delete-product/' . $product->id) }}" */ ?>
                                            href="javascript:" class="deleteRecord btn btn-danger btn-mini"
                                            title="Delete Product">Delete</a>
                                        @endif
                                    </td>
                                </tr>

                                <div id="myModal{{ $product->id }}" class="modal hide">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button">×</button>
                                        <h3>{{ $product->product_name }} Full Details</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Product ID:</strong> {{ $product->id }}</p>
                                        <p><strong>Category ID:</strong> {{ $product->category_id }}</p>
                                        <p><strong>Product Code:</strong> {{ $product->product_code }}</p>
                                        <p><strong>Product Color:</strong> {{ $product->product_color }}</p>
                                        <p><strong>Price:</strong> USD {{ $product->price }}</p>
                                        <p><strong>Material:</strong> </p>
                                        <p><strong>Description:</strong> {{ $product->description }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection