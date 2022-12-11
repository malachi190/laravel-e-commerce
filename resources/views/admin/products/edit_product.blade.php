@extends('admin.template.admin_template')

@section('content')
<main class="container">
    <div class="pb-3">
        <h1>Add Product</h1>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-grid">
                <form action="{{route('update_product', $id)}}" method="POST" enctype="multipart/form-data">
                   @method('PUT')
                   @csrf
                    <div class="card-body">
                        @foreach($all_products as $all_product)
                        <div class="form-group">
                            <label class="form-label">Product Title</label>
                            <input class="form-control mb-2 input-credit-card" type="text" placeholder="Enter product title" name="product_title" value="{{$all_product->product_title}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Product Description</label>
                            <input class="form-control input-date mb-2" type="text" placeholder="Enter product description" name="product_description" value="{{$all_product->product_description}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Product Image</label>
                            <input class="form-control input-numeral mb-2" type="file" name="product_image" value="{{$all_product->product_image}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Product Category</label>
                             <select name="product_category" class="form-control">
                                <option selected disabled>--Select Product Category--</option>
                                @foreach($category as $data)
                                <option value="{{$data->category_name}}">{{$data->category_name}}</option>
                                @endforeach
                             </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Product Price</label>
                            <input class="form-control input-prefix mb-2" type="number" placeholder="Enter product price" name="product_price" value="{{$all_product->product_price}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Product Discount Price</label>
                            <input class="form-control input-prefix mb-2" type="number" placeholder="Enter product discount price" name="product_discount_price" value="{{$all_product->product_discount_price}}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Product Quantity</label>
                            <input class="form-control input-prefix mb-2" type="text" placeholder="Enter product quantity" name="product_quantity" value="{{$all_product->product_quantity}}">
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark px-3">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection