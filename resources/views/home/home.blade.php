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

    <!--/slider-->
    @include('home.components.slider')

    <section>
        <div class="container">
            <div class="row">

                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <!--feature_product-->
                @include('home.components.feature_product')

                <!--/category-tab-->
                @include('home.components.category_tab_product')

                <!--Sán phẩm bán chạy-->
                    @include('home.components.recommend_product')

                </div>
            </div>
        </div>
    </section>

@endsection

<body>

</body>
</html>
