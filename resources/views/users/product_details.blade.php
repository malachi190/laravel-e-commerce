@extends('main-layout.template')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-success">
                <button class="close" aria-hidden="true" data-dismiss="alert">x</button>
                <p>{{session()->get('message')}}</p>
            </div>
        @endif
        <div class="col-md-8">
            <div class="product">
                <div class="product-img">
                    <img src="{{asset('/product_images/'. $product->product_image)}}" alt="" class="w-auto image-fluid" style="height: 80vh; width: 50%;">
                    <div class="product-label">
                        <span class="sale">-30%</span>
                        <span class="new">NEW</span>
                    </div>
                </div>
                <div class="product-body">
                    <p class="product-category">{{$product->product_category}}</p>
                    <h3 class="product-name"><a href="#">{{$product->product_title}}</a></h3>
                    <h4 class="product-price">${{$product->product_discount_price}} <del class="product-old-price">${{$product->product_price}}</del></h4>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                        <button class="add-to-wishlist">
                            <i class="fa fa-heart-o"></i>
                            <span class="tooltipp">add to wishlist</span>
                        </button>
                        <button class="add-to-compare">
                            <i class="fa fa-exchange"></i>
                            <span class="tooltipp">add to compare</span>
                        </button>
                        @if(Route::has('product_details'))
                        <span class="tooltipp">Order</span>
                        @else
                        <a href="{{route('product_details', $product->id)}}" class="mx-2">
                            <i class="fa fa-eye"></i>
                            <span class="tooltipp">View details</span>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="add-to-cart">
                    <form action="{{route('add_to_cart', $product->id)}}" method="POST">
                        @csrf
                        <div class="mx-auto">
                            <h3 style="color: white; text-align:start">Quantity</h3>
                            <input type="number" name="quantity" value="1" min="1" class="form-control" style="margin-bottom: 2rem; width: 50%; text-align:center;">
                        </div>
                        <div class="mx-auto">
                            <input type="submit" value="add to cart" class="add-to-cart-btn btn text-center">
                            <i class="fa fa-shopping-cart text-white"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="position:relative; top: 5rem; left: 4rem;">
            <div class="row">
                <div class="mx-auto">
                    <h4 class="text-danger">Short Description</h4>
                    <div class="mt-5 mb-3">
                        <p>{{$product->product_description}}</p>
                    </div>
                </div>

                <div class="mx-auto">
                    <h4 class="text-danger">Product Category</h4>
                    <div class="mt-5 mb-3">
                        <p>{{$product->product_category}}</p>
                    </div>
                </div>

                <div class="mx-auto">
                    <h4 class="text-danger">Product Availablility</h4>
                    <div class="mt-5 mb-3">
                        <p>{{$product->product_availability}}</p>
                    </div>
                </div>
                <div class="mx-auto">
                    <h4 class="text-danger">Quantity Left</h4>
                    <div class="mt-5 mb-3">
                        <p>{{$product->product_quantity}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection