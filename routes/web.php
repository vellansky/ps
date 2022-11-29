<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Profile\LoginController;
use App\Http\Controllers\Shop\Category\CategoryController;
use App\Http\Controllers\Shop\Product\ProductsController;
use App\Http\Controllers\Shop\Global\ContactsController;
use App\Http\Controllers\Shop\indexController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\User\CityController;

/*
require __DIR__.'/auth.php';



Route::post('register', [RegisteredUserController::class, 'store']);
*/
//Админ
Route::get('/admin/{any?}', [AdminController::class, 'index'])->name('AdminIndex')->middleware('auth');
Route::get('/admin/warehouse', [AdminController::class, 'warehouse'])->name('AdminWarehouse')->middleware('auth');
Route::get('/admin/products', [AdminController::class, 'products'])->name('AdminProducts')->middleware('auth');
Route::get('/admin/categories', [AdminController::class, 'categories'])->name('AdminСategories')->middleware('auth');
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('AdminOrders')->middleware('auth');
Route::get('/admin/settings', [AdminController::class, 'settings'])->name('AdminSettings')->middleware('auth');
Route::get('/admin/settings', [AdminController::class, 'settings'])->name('AdminSettings')->middleware('auth');
Route::view('/register','admin.profile.register')->name('register');

Route::get('/', function () {
    return redirect('/tomsk');
});

//Добавить товар в корзину
Route::post('/cart/add/', [CartController::class, 'addToCart']);
Route::post('/cart/deletes', [CartController::class, 'deletes']);
Route::post('/cart/quantity', [CartController::class, 'quantity']);
Route::post('/cart/clear', [CartController::class, 'clearCart']);

//Страница корзины
Route::view('/cart', 'user.cart')->name('cart');
Route::view('/order/{slug}', 'user.order')->name('order');
Route::post('/cart/items', [CartController::class, 'items']);

Route::get('/login', [LoginController::class, 'login'])->name('login');



Route::group(['prefix' => '{city}'], function () {
    // Главная страница
    Route::view('/', 'user.index')->name('index');
    //Страница категории
    Route::view('/catalog/{category}', 'user.category.index')->name('category');
    //Страница товара
    Route::view('/product/{product}', 'user.product.index')->name('product');
});
//Получить список категорий
Route::get('/catalog/list', [CategoryController::class, 'list']);




//Route::get('/catalog/{category}', [CategoryController::class, 'index'])->name('category');








Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Главная страница




//Страница контактов
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');











//user
Route::post('/user/city', [CityController::class, 'UserCity']);
//Получить города
Route::get('/user/city/list', [CityController::class, 'list']);
