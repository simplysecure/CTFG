@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-md-12 margin-bottom-40">
            <h2>
                @if(!empty(@$category->parentCategory->grandParent->ancestorCategory)) 
                    <a href="/listing-category/{{ $category->parentCategory->grandParent->ancestorCategory->slug }}">
                        {{ $category->parentCategory->grandParent->ancestorCategory->name }}
                    </a> > 
                @endif 
                @if(!empty($category->parentCategory->grandParent))
                    <span style="color: #7f8280; font-size: 22px;">
                        <a href="/listing-category/{{ $category->parentCategory->grandParent->slug }}">
                            {{ $category->parentCategory->grandParent->name }}
                        </a> > 
                    </span>
                @endif
                @if(!empty($category->parentCategory))
                    <span style="color: #7f8280; font-size: 22px;">
                        <a href="/listing-category/{{ $category->parentCategory->slug }}">
                            {{ $category->parentCategory->name }}
                        </a> > 
                    </span>
                @endif
                @if(!empty($category))
                    <span style="color: #7f8280; font-size: 22px;">
                        {{ $category->name }}
                    </span>
                @endif
                <span style="color: #7f8280; font-size: 22px;">
                    - ({{ @$projects->total() }})
                </span>
            </h2>

            @if(!empty($categoryDesc))
                @if(strlen($categoryDesc) > 310)
                    <p style="line-height: 20px !important; font-size: 14px;">{{ substr($categoryDesc, 0, 310) }}<span id="dots"> ...</span><span id="more">{{ substr($categoryDesc, 310, strlen($categoryDesc)) }}</span><a href="#" onclick="myFunction()" id="readMore" style="color: blue;"> &nbsp;&nbsp;[++ Expand ++]</a></p>
                @else
                    <p style="line-height: 20px !important; font-size: 14px;">{{ $categoryDesc }}</p>
                @endif
            @endif
        </div>

        <div class="col-md-12" style="margin-bottom: 20px;">
            @include('partials.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="sidebar">
                <!-- Widget -->
                <div class="widget margin-bottom-40">
                    <h3 class="margin-top-0 margin-bottom-30">Categories</h3>
                    @include('partials.categories')
                </div>
            </div>
        </div>


        <div class="col-lg-9 col-md-8 padding-right-30">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            @include('partials.filters')
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="listings-container list-layout">
                                @include('partials.paginated-projects')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    {{ $projects->withQueryString()->links() }}
                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection