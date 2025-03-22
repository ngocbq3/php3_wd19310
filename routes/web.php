<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello', function () {
    return view('hello');
});
//Đường dẫn có thám số
Route::get('/users/{id}', function ($id) {
    return "USER: $id";
});
//Điều kiện cho tham số
Route::get('/comments/{id}', function ($id) {
    return "Comment id: $id";
})->where('id', '[0-9]+');

//Đặt tên cho đường dẫn
Route::get('/profilelkl01923021oaskdoa', function () {
    return "Profile";
})->name('profile');


//Sử dụng controller trong route
Route::get('/products', [ProductController::class,          'index']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

//Danh sách sản phẩm theo danh mục
Route::get('/category/{id}', [CategoryController::class, 'list'])->name('category.list');

//Sử dụng resource 
Route::resource('/my', MyController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/products', AdminProductController::class);
});
