<?php

namespace App\Http\Controllers;

use App\Models\AddCategory;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function add_product()
    {
        $category_data = AddCategory::all();
        return view('admin.products.add_product', compact('category_data'));
    }

    public function add_product_data(Request $request)
    {
        $request->validate([
            'product_title' => 'required',
            'product_description' => 'required | max:208',
            'product_image' => 'required | mimes:jpg,png,svg | max:5080',
            'product_category' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
            'product_discount_price' => 'required',
        ]);

        $extension = $request->product_image->getClientOriginalExtension();
        $product_image_name = time() . '.' . $extension;
        $request->product_image->move('./product_images/', $product_image_name);

        $products = Products::create([
            'product_title' => $request->product_title,
            'product_description' => $request->product_description,
            'product_image' =>  $product_image_name,
            'product_category' => $request->product_category,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_discount_price' => $request->product_discount_price
        ]);
        $products->save();

        return redirect()->back()->with('message', 'Product added successfully!');
    }

    public function view_all_products(){
        $all_products = Products::paginate(7)->withQueryString();
        return view('admin.products.all_products', compact('all_products'));
    }

    public function edit_products($id)
    {
        $all_products = Products::where('id', '=', $id)->get();
        $category = AddCategory::all();
        return view('admin.products.edit_product', compact('id','all_products', 'category'));
    }

    public function update_product(Request $request, $id){
        $products = Products::where('id', '=', $id);

        $extension = $request->product_image->getClientOriginalExtension();
        $product_image_name = time() . '.' . $extension;
        $request->product_image->move('./product_images/', $product_image_name);

        $products->update([
            'product_title' => $request->product_title,
            'product_description' => $request->product_description,
            'product_image' =>  $product_image_name,
            'product_category' => $request->product_category,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_discount_price' => $request->product_discount_price
        ]);
        return redirect()->route('all_products')->with('message', "Product Updated Successfully!");
    }

    public function delete_product($id)
    {
        $products = Products::where('id', '=', $id);

        $products->delete();
        return redirect()->back()->with('delete-message', 'Product Deleted!');
    }

    public function product_details($id)
    {
        $product = Products::find($id);
        return view('users.product_details', compact('product'));
    }

    public function all_cart()
    {
        return view('users.cart_product');
    }

    public function add_cart(Request $request, $id)
    {
        if(Auth::id()){
          $user = Auth::user();
          $product = Products::find($id);
          $cart = Cart::create([
            'name' => $user->name,
            'email' => $user->email,
            'product_title' => $product->product_title,
            'product_price' => $product->product_price,
            'product_total' => $product->product_price * $request->quantity,
            'product_subtotal' => $product->product_price * $request->quantity,
            'product_quantity' => $request->quantity,
            'product_image' => $product->product_image,
            'product_id' => $product->id,
            'user_id' => $user->id
          ]);
          $cart->save();

          return redirect()->back()->with('message', 'Item added to cart!');
        }
        else{
            return redirect('login');
        }
    }
}
