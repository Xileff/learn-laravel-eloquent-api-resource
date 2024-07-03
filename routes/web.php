<?php

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategorySimpleResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
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
    return new ProductResource($product);
});
