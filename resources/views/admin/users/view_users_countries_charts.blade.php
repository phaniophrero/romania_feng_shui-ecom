@extends('layouts.adminLayout.admin_design')
@section('content')
<script>
    window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light2",
        animationEnabled: true,
        title: {
        text: "Registered Users Countries"
        },
        data: [{
            type: "doughnut",
                indexLabel: "{symbol}  {y}",
                yValueFormatString: "#,##0.0\"%\"",
                showInLegend: true,
                legendText: "{label} : {y}",
                dataPoints: [
                    {y: <?php echo $getUserCountries[0]['count']; ?> , label: "<?php echo $getUserCountries[0]['country']; ?>"},
                    {y: <?php echo $getUserCountries[1]['count']; ?> , label: "<?php echo $getUserCountries[1]['country']; ?>"},
                    {y: <?php echo $getUserCountries[2]['count']; ?> , label: "<?php echo $getUserCountries[2]['country']; ?>"},
                    {y: <?php echo $getUserCountries[3]['count']; ?> , label: "<?php echo $getUserCountries[3]['country']; ?>"}
                ]
            }]
        });
        chart.render();
    }
</script>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                Home</a> <a href="#">Users Countries Charts</a> <a href="#" class="current">View Users Countries
                Charts</a> </div>
        <h1>Users Countries Charts</h1>
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
                        <h5>Users Countries Charts</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection