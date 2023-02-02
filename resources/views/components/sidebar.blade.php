<!--/danh mục sản phẩm-->
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian">
            @foreach($categories as $category)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            @if($category->categoryChildrent->count())
                                <a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{$category->id}}">
                                <span class="badge pull-right">
                                    <!--check xem nếu có danh mục con thì mới có dấu + ,không có thì thôi bỏ dấu + -->
                                    @if($category->categoryChildrent->count())
                                        <i class="fa fa-plus"></i>
                                    @endif
                                </span>
                                    {{$category->name}}
                                </a>
                            @else
                                <a  href="#">
                                <span class="badge pull-right">
                                </span>
                                    {{$category->name}}
                                </a>
                            @endif
                        </h4>
                    </div>
                    <div id="sportswear_{{$category->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category->categoryChildrent as  $categoryChildrent)
                                    <li>
                                        <a href="{{route('category.product',['slug'=>$categoryChildrent->slug,'id'=>$categoryChildrent->id])}}">
                                            {{$categoryChildrent->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
