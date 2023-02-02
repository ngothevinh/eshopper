@extends('layouts.master')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <link href="{{asset('home/home.js')}}" rel="stylesheet">
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')
                <div class="col-sm-9 padding-right">
                    <h2 class="title text-center">Chi tiết sản phẩm</h2>
                    <div class="product-details">
                        @foreach($productsDetail as $productDetailItem)
                            <div class="col-sm-5">
                                <div class="view-product">
                                    <img src="{{config('app.base_url') . $productDetailItem->feature_image_path}}"
                                         style="object-fit: contain" alt="">
                                </div>
                                <div id="similar-product" class="carousel slide" data-ride="carousel">
                                    <div style="display: inline-flex">
                                        @foreach($productImage as $productImageItem)
                                            <img src="{{config('app.base_url') . $productImageItem->image_path}}"
                                                 alt="" style="padding-right: 4px;">
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <div class="product-information">
                                    <h2>{{$productDetailItem->name}}</h2>
                                    <p>ID sản phẩm:{{$productDetailItem->id}}</p>
                                    <h2 style="margin-top: 20px;color: #eea236"> Giá sản
                                        phẩm : {{number_format($productDetailItem->price)}} VNĐ</h2><br>

                                    <a   href="#"
                                         class="btn btn-primary add_cart"
                                         data-url="{{route('cart.add',['id'=>$productDetailItem->id])}}">
                                        <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-9 padding-right">
                @include('home.components.category_tab_product')
                @include('home.components.recommend_product')
            </div>
            </div>
    </section>
@endsection




