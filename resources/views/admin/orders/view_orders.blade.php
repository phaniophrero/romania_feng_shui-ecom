@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a> <a href="#">Orders</a> <a href="#" class="current">View Orders</a> </div>
        <h1>Orders</h1>
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
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>Orders</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Ordered Products</th>
                                    <th>Order Amount</th>
                                    <th>Order Status</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="gradeX">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->user_email }}</td>
                                    <td>
                                        @foreach ($order->orders as $pro)
                                        {{ $pro->product_code }}
                                        ({{ $pro->product_qty }})
                                        <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->grand_total }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td class="center">
                                        @if(Session::get('adminDetails')['orders_view_access'] == 1)
                                        <a href="{{ url('admin/view-order/'. $order->id) }}" style="margin-bottom: 5px;"
                                            class="btn btn-success btn-mini" title="View Order">View Order
                                            Details</a> <br> <br>
                                        @if($order->order_status == "Shipped" || $order->order_status == "Delivered" ||
                                        $order->order_status == "Paid")
                                        <a href="{{ url('admin/view-order-invoice/'. $order->id) }}" target="_blank"
                                            class="btn btn-warning btn-mini" title="View Order">View Order
                                            Invoice</a> <br><br>
                                        <a href="{{ url('admin/view-pdf-invoice/'. $order->id) }}" target="_blank"
                                            class="btn btn-primary btn-mini" title="Download PDF">Download PDF
                                            Invoice</a>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
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