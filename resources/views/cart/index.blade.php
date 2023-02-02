@extends('layouts.master')

@section('title')
    <title>Giỏ hàng</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <link href="{{asset('home/home.js')}}" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection


<body>
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            <form action="{{route('cart.postCheckout')}}" method="post">
                @if(is_countable($carts) && count($carts) > 0)
                    <div class="review-payment">
                        <h2>Thông tin đơn hàng</h2>
                        <div class="table-responsive cart_info deleteCartUrl" data-url="{{route('cart.delete')}}">
                            <table class="table table-condensed updateCartUrl" data-url="{{route('cart.update')}}">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Hình ảnh</td>
                                    <td class="name">Tên sản phẩm</td>
                                    <td class="price">Giá tiền</td>
                                    <td class="quantity">Số lượng</td>
                                    <td class="total">Tổng tiền</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total=0
                                @endphp
                                @foreach($carts as $id => $cart)
                                    @php
                                        $total+= $cart['price'] * $cart['quantity']
                                    @endphp
                                    <tr>
                                        <td class="cart_product">
                                            <img src="{{config('app.base_url') . $cart['image']}}" alt=""
                                                 class="image_cart">
                                        </td>
                                        <td class="cart_description">
                                            <p name="name">{{$cart['name']}}</p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{number_format($cart['price'])}} VNĐ</p>
                                            <input type="hidden" name="price" value="{{$cart['price']}}">

                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <input type="number" class="quantity" name="quantity"
                                                       value="{{$cart['quantity']}}" min="1">
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price"
                                               name="total_price"> {{ number_format($cart['price'] * $cart['quantity'])}}
                                                VNĐ</p>
                                        </td>
                                        <td>
                                            <a href="#" data-id="{{ $id }}"
                                               class="btn btn-primary update_cart">Update</a>
                                            <a href="#" data-id="{{ $id }}"
                                               class="btn btn-danger delete_cart">Delete</a>
                                        </td>
                                        <input type="hidden" name="pruduct_id" value="{{$id}}">
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h3 style="float: right;margin-bottom: 100px; ">Tổng tiền các sản phẩm:
                            <span style="color: #FE980F">{{number_format($total)}} VNĐ</span>
                        </h3>
                    </div>
                    <div class="shopper-informations">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="shopper-info">
                                    <p>Thông tin khách hàng</p>
                                    <form>
                                        <div class="form-group">
                                            <label>Họ và tên</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="name"
                                                   placeholder="Họ và tên"
                                                   @error('name')is-invalid @enderror>
                                        </div>
                                        @error('name')
                                        <div class="alert alert-danger ">{{$message}}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label>Địa chỉ</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="address"
                                                   placeholder="Địa chỉ"
                                                   @error('address')is-invalid @enderror>
                                        </div>
                                        @error('address')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="phone"
                                                   placeholder="Số điện thoại"
                                                   @error('phone')is-invalid @enderror>
                                        </div>
                                        @error('phone')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="order-message">
                                    <p>Mô tả chi tiết đơn hàng</p>
                                    <textarea name="description" placeholder="Ghi chú" rows="16"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary checkout_bill">Thanh toán</button>
                        @csrf
                    </div>
                @else
                    <h1 style="text-align: center;padding-bottom: 328px;">Giỏ hàng trống</h1>
                @endif
            </form>
        </div>
    </section>


@endsection
</body>
</html>
