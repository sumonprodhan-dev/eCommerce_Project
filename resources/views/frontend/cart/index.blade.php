@extends('layouts.frontend.master')


@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- Start cart Wrapper -->
    <div class="shopping-cart-wrapper pb-70">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <main id="primary" class="site-main">
                        <div class="shopping-cart">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h3>Shopping Cart</h3>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>Image</td>
                                                    <td>Product Name</td>
                                                    <td>Quantity</td>
                                                    <td>Unit Price</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse ($cartItems as $cart)
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="{{ route('product.detail', $cart->attributes->slug) }}"><img
                                                                    src="{{ asset($cart->attributes->image->image ?? '') }}"
                                                                    alt="Cart Product Image" title="Compete Track Tote"
                                                                    class="img-thumbnail"></a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('product.detail', $cart->attributes->slug) }}">
                                                                {{ $cart->name }}
                                                            </a>

                                                        </td>

                                                        <td>
                                                            <div class="input-group btn-block">

                                                                <form action="{{ route('cart.update', $cart->id) }}"
                                                                    method="post" class="d-inline-block">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="product-qty me-1">
                                                                        <input type="number" min="1" name="quantity"
                                                                            value="{{ $cart->quantity }}">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-refresh"></i>
                                                                    </button>
                                                                </form>

                                                                <form action="{{ route('cart.destroy', $cart->id) }}"
                                                                    method="post" class="d-inline-block ">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger pull-right">
                                                                        <i class="fa fa-times-circle"></i>
                                                                    </button>
                                                                </form>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>৳{{ $cart->price }}</td>
                                                        <td>৳{{ Cart::get($cart->id)->getPriceSum() }}</td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="cart-amount-wrapper">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-4 offset-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Sub-Total:</strong></td>
                                                            <td><span>৳{{ Cart::getSubTotal() }}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Shipping Charge:</strong></td>
                                                            <td><span>৳100</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Total:</strong></td>
                                                            <td><span
                                                                    class="color-primary">৳{{ Cart::getTotal() + 100 }}</span></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cart-button-wrapper d-flex justify-content-between mt-4">

                                        <div class="d-flex gap-4">
                                            <a href="{{ route('products') }}" class="btn btn-secondary">Continue
                                                Shopping</a>
                                            <form action="{{ route('cart.clear') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning">Clear Cart</button>
                                            </form>

                                        </div>

                                        <a href="{{ route('checkout')}}" class="btn btn-secondary dark align-self-end">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of shopping-cart -->
                    </main> <!-- end of #primary -->
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- End cart Wrapper -->
@endsection
