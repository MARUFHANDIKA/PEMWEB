<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function list()
    {
        $menu = Product::when(request('key'), function ($query, $key) {
            $query->where('name', 'like', '%' . $key . '%');
        })
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('admin.product.list', compact('menu'));
    }

    // Menampilkan form tambah produk
    public function new()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.new', compact('categories'));
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.product.show', compact('product'));
    }

    // Menyimpan produk baru
    public function create(Request $request)
    {
        $this->productValidation($request);

        $productData = $this->getData($request);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $productData['image'] = $fileName;
        }

        Product::create($productData);
        return redirect()->route('product#list')->with(['success' => 'Product created successfully']);
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    // Menyimpan perubahan produk
    public function update($id, Request $request)
    {
        $this->productValidation($request);

        $productData = $this->getData($request);

        // Cek jika user upload gambar baru
        if ($request->hasFile('image')) {
            $dbProduct = Product::where('id', $request->id)->first();
            $dbImage = $dbProduct->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $productData['image'] = $fileName;
        }

        Product::where('id', $request->id)->update($productData);
        return redirect()->route('product#list')->with(['success' => 'Product updated successfully']);
    }

    // Menghapus produk
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['success' => 'Product deleted successfully']);
    }

    // Ambil data input dari form
    private function getData($request)
    {
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
            'stock' => $request->stock,
            'updated_at' => Carbon::now(),
        ];
    }

    // Validasi input form
    private function productValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:4|unique:products,name,' . $request->id,
            'category' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg,web,webp|file',
            'price' => 'required|numeric',
            'waitingTime' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
        ])->validate();
    }
}
