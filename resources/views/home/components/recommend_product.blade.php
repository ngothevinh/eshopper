<!--Sán phẩm bán chạy-->
<div class="recommended_items">
    <h2 class="title text-center">Sản phẩm bán chạy</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($productsRecommend as $keyRecommand=>$productsRecommendItem)
                @if($keyRecommand % 3 == 0)
                    <div class="item {{$keyRecommand == 0 ?'active':''}}">
                        @endif
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img
                                            src="{{config('app.base_url') . $productsRecommendItem->feature_image_path}}"
                                            alt=""/>
                                        <h2>{{number_format($productsRecommendItem->price)}} VNĐ</h2>
                                        <p>{{$productsRecommendItem->name}}</p>
                                        <a  href="#"
                                            class="btn btn-default add_cart"
                                            data-url="{{route('cart.add',['id'=>$productsRecommendItem->id])}}">
                                            <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                        </a>
                                        <ul  class="btn btn-default" style="margin-top: 10px">
                                            <li>
                                                <a style="color:#40403E; " href="{{route('cart.detailProduct',['id'=>$productsRecommendItem->id])}}">Chi tiết sản phẩm</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($keyRecommand % 3 == 2)
                    </div>
                @endif
            @endforeach
        </div>

        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
