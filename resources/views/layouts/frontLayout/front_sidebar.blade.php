<?php use App\Product; ?>

<form action="{{ url('/products-filter') }}" method="post">
    {{ csrf_field() }}
    @if(!empty($url))
    <input name="url" value="{{ $url }}" type="hidden">
    @endif
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
            @foreach ($categories as $cat)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{ $cat->id }}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{ $cat->name }}
                        </a>
                    </h4>
                </div>
                <div id="{{ $cat->id }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($cat->categories as $subcat)
                            <?php $productCount = Product::productCount($subcat->id); ?>
                            <li><a
                                    href="{{ asset('/products/'.$subcat->url) }}">{{ $subcat->name }}</a>({{ $productCount }})
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--/category-products-->

        @if(!empty($url))
        <h2>Colors</h2>
        <div class="panel-group">
            @foreach ($colorArray as $color)
            @if(!empty($_GET['color']))
            <?php $colorArray = explode('-',$_GET['color']); ?>
            @if(in_array($color, $colorArray))
            <?php $colorcheck = "checked"; ?>
            @else
            <?php $colorcheck = ""; ?>
            @endif
            @else
            <?php $colorcheck = ""; ?>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <input name="colorFilter[]" onchange="javascript:this.form.submit();" id="{{ $color }}"
                            value="{{ $color }}" type="checkbox" {{ $colorcheck }}>&nbsp;<span
                            class="products-colors">{{ $color }}</span>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>

        <div>&nbsp;</div>

        <h2>Used For</h2>
        <div class="panel-group">
            @foreach ($used_forArray as $used_for)
            @if(!empty($_GET['used_for']))
            <?php $used_forArray = explode('-',$_GET['used_for']); ?>
            @if(in_array($used_for, $used_forArray))
            <?php $used_forcheck = "checked"; ?>
            @else
            <?php $used_forcheck = ""; ?>
            @endif
            @else
            <?php $used_forcheck = ""; ?>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <input name="used_forFilter[]" onchange="javascript:this.form.submit();" id="{{ $color }}"
                            value="{{ $used_for }}" type="checkbox" {{ $used_forcheck }}>&nbsp;<span
                            class="products-colors">{{ $used_for }}</span>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>

        <div>&nbsp;</div>

        <h2>Size</h2>
        <div class="panel-group">
            @foreach ($sizesArray as $size)
            @if(!empty($_GET['size']))
            <?php $sizesArray = explode('-',$_GET['size']); ?>
            @if(in_array($size, $sizesArray))
            <?php $size_forcheck = "checked"; ?>
            @else
            <?php $size_forcheck = ""; ?>
            @endif
            @else
            <?php $size_forcheck = ""; ?>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <input name="sizeFilter[]" onchange="javascript:this.form.submit();" id="{{ $size }}"
                            value="{{ $size }}" type="checkbox" {{ $size_forcheck }}>&nbsp;<span
                            class="products-colors">{{ $size }}</span>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>

        <div>&nbsp;</div>

        @endif

        {{-- <div class="price-range">
            <!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                    data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div> --}}
        <!--/price-range-->
    </div>
</form>