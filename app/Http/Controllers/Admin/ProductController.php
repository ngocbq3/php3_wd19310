<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = DB::table('products')
        //     ->join('categories', 'categories.id', '=', 'products.category_id')
        //     ->select(['products.*', 'categories.name as cate_name'])
        //     ->orderBy('id', 'desc')
        //     ->paginate(10);

        //Lấy tất cả dữ liệu
        $products = Product::all();

        //Lấy dữ liệu có phân trang và sắp xếp
        $products = Product::with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = DB::table('categories')->get();

        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // $data = $request->except('_token');//Query build
        $data = $request->all();

        //Xử lý file
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
        }
        $data['image'] = $path_image ?? null;

        // DB::table('products')->insert($data);
        $product = Product::query()->create($data); //Eloquent ORM

        return redirect()
            ->route('admin.products.edit', $product->id)
            ->with('message', 'Thêm dữ liệu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view(
            'admin.products.edit',
            compact('product', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('image');

        //Cập nhật file
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }

        //cập nhật
        Product::find($id)->update($data);

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('products')->delete($id);

        $product = Product::find($id);

        if (Storage::fileExists($product->image)) {
            Storage::delete($product->image);
        }
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('message', 'Xóa dữ liệu thành công');
    }
}
