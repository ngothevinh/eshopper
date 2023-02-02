
<!--main_menu-->
<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{route('home')}}" class="active">Trang chủ</a></li>
        <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
            <ul role="menu" class="sub-menu">
                <li><a href="{{route('cart.productAll')}}">Danh sách sản phẩm</a></li>
            </ul>
        </li>
    @foreach($categoriesLimit as $categoryParent)
            <li class="dropdown">
                <a href="#">
                    {{$categoryParent->name}}
                    <i class="fa fa-angle-down"></i>
                </a>
                @include('components.child_menu',['categoryParent'=>$categoryParent])
            </li>
        @endforeach

        <li><a href="{{route('error.product')}}">404</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</div>
