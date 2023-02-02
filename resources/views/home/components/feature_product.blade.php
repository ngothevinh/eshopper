<!--sản phẩm nổi bật-->
<div class="features_items">
    <h2 class="title text-center">Sản phẩm nổi bật</h2>
    @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{config('app.base_url') . $product->feature_image_path}}" alt=""/>
                        <h2>{{number_format($product->price)}} VNĐ</h2>
                        <p>{{$product->name}}</p>
                        <a   href="#"
                             class="btn btn-default add_cart"
                             data-url="{{route('cart.add',['id'=>$product->id])}}">
                            <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                        </a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{ number_format($product->price)}} VNĐ</h2>
                            <p>{{$product->name}}</p>
                            <a   href="#"
                                class="btn btn-default add_cart"
                                data-url="{{route('cart.add',['id'=>$product->id])}}">
                                <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li>
                            <a   href="{{route('cart.detailProduct',['id'=>$product->id])}}">Chi tiết sản phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>



