@extends('layouts.frontend.master')

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area mb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- shop page main wrapper start -->
    <div class="main-wrapper pt-35">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-shop-main-wrapper">
                        <div class="shop-baner-img mb-70">
                            <a href="#"><img src="{{ asset('assets/frontend/img/banner/category-image.jpg') }}"
                                    alt=""></a>
                        </div>

                        {{-- filter start --}}
                        <div class="shop-top-bar mb-30">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a href="#" data-target="column_3"><span>3-col</span></a>
                                            <a class="active" href="#" data-target="grid"><span>4-col</span></a>
                                            <a href="#" data-target="list"><span>list</span></a>
                                        </div>
                                        <div class="product-page">
                                            <p>Showing 1 to 9 of 9 (1 Pages)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="top-bar-right">
                                        <div class="per-page">
                                            <p>Show : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">10</option>
                                                <option value="sales">20</option>
                                                <option value="sales">30</option>
                                                <option value="rating">40</option>
                                                <option value="date">50</option>
                                                <option value="price-asc">60</option>
                                                <option value="price-asc">70</option>
                                                <option value="price-asc">100</option>
                                            </select>
                                        </div>
                                        <div class="product-short">
                                            <p>Sort By : </p>
                                            <select class="nice-select" name="sortby">
                                                <option value="trending">Relevance</option>
                                                <option value="sales">Name (A - Z)</option>
                                                <option value="sales">Name (Z - A)</option>
                                                <option value="rating">Price (Low &gt; High)</option>
                                                <option value="date">Rating (Lowest)</option>
                                                <option value="price-asc">Model (A - Z)</option>
                                                <option value="price-asc">Model (Z - A)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- filter end --}}

                        {{-- product start --}}
                        <div class="shop-product-wrap grid row">

                            @forelse ($products as $key=> $product)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product-item mb-30">
                                        <div class="product-thumb">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                @forelse ($product->productImages as $key => $image)
                                                    <img src="{{ asset($image->image) }}"
                                                        class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}" alt="">
                                                @empty
                                                @endforelse
                                            </a>
                                            <div class="box-label">
                                                <div class="label-product label_new">
                                                    <span>new</span>
                                                </div>
                                                @if ($product->discount > 0)
                                                    <div class="label-product label_sale">
                                                        <span>-{{ $product->discount }}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="action-links">
                                                <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>

                                                <a href="#" title="Quick view" data-bs-target="#quickk_view"
                                                    data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="manufacture-product">
                                                <p>
                                                    <a href="shop-grid-left-sidebar.html">
                                                        {{ $product->brand->name ?? '' }}
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="product-name">
                                                <h4><a
                                                        href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                                </h4>
                                            </div>
                                            <div class="price-box">
                                                @if ($product->discount > 0)
                                                    <span class="regular-price"><span
                                                            class="special-price">৳ {{ $product->discount_price }}</span></span>
                                                    <span class="old-price"><del>৳ {{ $product->price }}</del></span>
                                                @else
                                                    <span class="old-price">৳ {{ $product->price }}</span>
                                                @endif
                                            </div>
                                            <form action="{{ route('cart.add', $product->id) }}" method="post">
                                                @csrf
                                                <button class="btn-cart" type="submit">add to cart</button>
                                            </form>
                                        </div>
                                    </div> <!-- end single grid item -->

                                    <div class="sinrato-list-item mb-30">
                                        <div class="sinrato-thumb">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                @forelse ($product->productImages as $key => $image)
                                                    <img src="{{ asset($image->image) }}"
                                                        class="{{ $key == 0 ? 'pri-img' : 'sec-img' }}" alt="">
                                                @empty
                                                @endforelse
                                            </a>
                                            <div class="box-label">
                                                @if ($product->discount > 0)
                                                    <div class="label-product label_sale">
                                                        <span>-{{ $product->discount }}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="sinrato-list-item-content">
                                            <div class="manufacture-product">
                                                <span><a href="#">{{ $product->brand->name ?? '' }}</a></span>
                                            </div>
                                            <div class="sinrato-product-name">
                                                <h4><a
                                                        href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                                </h4>
                                            </div>

                                            <div class="sinrato-product-des">
                                                <p>{{ $product->short_description }}</p>
                                            </div>
                                        </div>
                                        <div class="sinrato-box-action">
                                            <div class="price-box">
                                                @if ($product->discount > 0)
                                                    <span class="regular-price"><span
                                                            class="special-price">৳ {{ $product->discount_price }}</span></span>
                                                    <span class="old-price"><del>৳ {{ $product->price }}</del></span>
                                                @else
                                                    <span class="old-price">৳ {{ $product->price }}</span>
                                                @endif
                                            </div>
                                            <form action="{{ route('cart.add', $product->id) }}" method="post">
                                                @csrf
                                                <button class="btn-cart" type="submit">add to cart</button>
                                            </form>

                                            <div class="action-links sinrat-list-icon">
                                                <a href="#" title="Wishlist"><i class="lnr lnr-heart"></i></a>
                                                <a href="#" title="Quick view" data-bs-target="#quickk_view"
                                                    data-bs-toggle="modal"><i class="lnr lnr-magnifier"></i></a>
                                            </div>
                                        </div>
                                    </div> <!-- end single list item -->
                                </div>
                            @empty
                            @endforelse


                        </div>
                        {{-- product end --}}

                        {{-- pagination start --}}

                        <div class="paginatoin-area style-2 pt-35 pb-20">
                            <div class="row">

                                {{ $products->links() }}
                                {{-- <ul class="pagination-box pagination-style-2">
                                        <li><a class="Previous" href="#">Previous</a>
                                        </li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li>
                                            <a class="Next" href="#"> Next </a>
                                        </li>
                                    </ul> --}}

                            </div>
                        </div> {{-- pagination edn --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop page main wrapper end -->
@endsection
