<div class="header-bottom sticky-content fix-top sticky-header">
    <div class="container">
        <div class="inner-wrap">
            <div class="header-left">
                <div class="dropdown category-dropdown has-border" data-visible="true">
                    <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="true" data-display="static"
                       title="Browse Categories">
                        <i class="w-icon-category"></i>
                        <span>Browse Categories</span>
                    </a>

                    <div class="dropdown-box">
                        <ul class="menu vertical-menu category-menu">
                            @foreach(getParentCategories() as $key => $category)
                            <li @if(count($category->childCategory)) class="has-submenu" @endif>
                                <a href="{!! route('getProducts',[$category->name]) !!}"></i>{!! $category->name !!}</a>
                                @if(count($category->childCategory))
                                <ul class="menu vertical-menu category-menu">
                                    @foreach($category->childCategory as $first_child)
                                    <li @if(count($first_child->childCategory)) class="has-submenu" @endif>
                                        <a href="{!! route('getProducts',[$first_child->name]) !!}">{!! $first_child->name !!}</a>
                                        @if(count($first_child->childCategory))
                                        <ul class="menu vertical-menu category-menu">
                                            @foreach($first_child->childCategory as $key => $second_child)
                                                <li ><a href="{!! route('getProducts',[$second_child->name]) !!}">{!! $second_child->name !!}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <i class="w-icon-map-marker mr-1" style="font-size: 2.2rem;"></i>
                <a href="{{route('trackOrder')}}" class="d-xl-show">Track Order</a>
                {{--                <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>--}}
            </div>
        </div>
    </div>
</div>
