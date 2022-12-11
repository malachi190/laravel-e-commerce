@extends('admin.template.admin_template')

@section('content')
<div class="container">
    <h1 class="mb-4">All added products</h1>
    @if(Session::has('delete-message'))
    <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <p class="text-dark fs-2">{{session()->get('delete-message')}}</p>
    </div>
    @endif
    @if(Session::has('message'))
    <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <p class="text-dark fs-2">{{session()->get('message')}}</p>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card mb-grid">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-header-title">ALL PRODUCTS</div>
                </div>
                <div class="table-responsive-md">
                    <table class="table table-actions table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label class="custom-control custom-checkbox m-0 p-0">
                                        <input type="checkbox" class="custom-control-input table-select-all">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Discount Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_products as $all_product)
                            <tr>
                                <th scope="row">
                                    <label class="custom-control custom-checkbox m-0 p-0">
                                        <input type="checkbox" class="custom-control-input table-select-row">
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </th>
                                <td>{{$all_product->id}}</td>
                                <td>{{$all_product->product_title}}</td>
                                <td>{{$all_product->product_description}}</td>
                                <td>${{$all_product->product_price}}</td>
                                <td><img src="{{asset('/product_images/'. $all_product->product_image)}}" alt="" width="50" height="50"></td>
                                <td>{{$all_product->product_category}}</td>
                                <td>{{$all_product->product_quantity}}</td>
                                <td>
                                    <span class="badge badge-pill badge-dark">${{$all_product->product_discount_price}}</span>
                                </td>
                                <td>
                                    <a href="{{route('edit_products',$all_product->id)}}" class="btn btn-sm btn-dark">Edit</a>
                                    <a href="{{route('delete_product', $all_product->id)}}" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this product?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer d-flex justify-content-end">
                  {!!$all_products->links('pagination::bootstrap-5')!!}
 
                </div>
            </div>
        </div>
    </div>

</div>


@endsection