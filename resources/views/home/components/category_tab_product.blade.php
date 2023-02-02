<!--/sản phẩm liên quan-->
<div class="category-tab">
    <div class="col-sm-12">
        <h2 class="title text-center">Sản phẩm liên quan</h2>
        <ul class="nav nav-tabs">
            <!--lấy tên các category cha-->
            @foreach($categories as $indexCategory=>$categoryItem)
                <li class="{{$indexCategory == 0 ?'active':''}}">
                    <a href="#category_tab_{{$categoryItem->id}}" data-toggle="tab">
                        {{$categoryItem->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        <!--lấy các category con từ category cha theo id rồi hiển thị-->
        @foreach($categories as $indexCategoryProduct=>$categoryItemProduct)
            <div class="tab-pane fade {{$indexCategoryProduct == 0 ?'active in':''}} "
                 id="category_tab_{{$categoryItemProduct->id}}">
                @foreach($categoryItemProduct->products as $productItemTabs)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{config('app.base_url') . $productItemTabs->feature_image_path}}"
                                         alt=""/>
                                    <h2>{{number_format($productItemTabs->price)}} VNĐ</h2>
                                    <p>{{$productItemTabs->name}}</p>
                                    <a href="#"
                                       class="btn btn-default add_cart"
                                       data-url="{{route('cart.add',['id'=>$productItemTabs->id])}}">
                                        <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                    </a>
                                    <ul class="btn btn-default" style="margin-top: 20px;">
                                        <li >
                                            <a
                                               href="{{route('cart.detailProduct',['id'=>$productItemTabs->id])}}">Chi
                                                tiết sản phẩm</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
