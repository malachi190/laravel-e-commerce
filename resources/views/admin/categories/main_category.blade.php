@extends('admin.template.admin_template')

@section('content')

<main class="container">
    <div class="pb-3 mt-5">
        <h2>Add Category</h2>
    </div>
    @if(Session::has('message'))
    <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <p class="text-dark fs-2">{{session()->get('message')}}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-grid">
                <div class="card-header">
                    <div class="card-header-title">Add Sections</div>
                </div>
                <form action="{{route('add.category')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Category Name</label>
                            <input class="form-control mb-2 input-credit-card" type="text" name="category_name" placeholder="Enter category name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date Added</label>
                            <input class="form-control input-date mb-2" type="date" name="date_added" placeholder="YYYY/MM/DD">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-dark text-white fs-3 px-3 text-center py-2 rounded-sm">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End -->
    <div class="row">
        <div class="col-md-6">
            <h3 class="fs-2 pb-3 mt-3">All Categories</h3>
            <!-- Category Table -->
            <!-- Table Seamless -->
            <div class="card mb-grid">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-header-title">Added product categories</div>
                </div>
                @if(Session::has('delete_message'))
                <div class="alert alert-danger">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    <p class="text-dark fs-2">{{session()->get('delete_message')}}</p>
                </div>
                @endif
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Category Name</th>
                            <th scope="col">Date Added</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->date_added}}</td>
                            <td>
                                <a href="{{route('delete_category', $category->id)}}" class="btn btn-danger" onclick="confirm('Are you sure you want to delete this?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card-footer d-flex justify-content-end">
                    <ul class="pagination pagination-clean pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">‹</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">›</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- // Table seamless -->
        </div>
    </div>
</main>




@endsection