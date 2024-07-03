<?php

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategorySimpleResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductDebugResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/categories/{id}', function ($id) {
    $category = Category::findOrFail($id);
    return new CategoryResource($category);
});

Route::get('/api/categories', function () {
    $categories = Category::all();
    return CategoryResource::collection($categories);
});

Route::get('/api/categories-custom', function () {
    $categories = Category::all();
    return new CategoryCollection($categories);
});

Route::get('/api/products/{id}', function ($id) {
    $product = Product::findOrFail($id);
    $product->load("category");
    return new ProductResource($product);
});

Route::get('/api/products', function () {
    $products = Product::all();
    return new ProductCollection($products);
});

Route::get('/api/products-paging', function (Request $request) {
    $page = $request->get('page', 1);
    $products = Product::paginate(perPage: 2, page: $page);
    return new ProductCollection($products);
});

Route::get('/api/products-debug/{id}', function ($id) {
    $product = Product::find($id);
    return new ProductDebugResource($product);
});
