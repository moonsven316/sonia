<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Searchcontroller;
use App\Http\Controllers\ShopcreateController;
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
//    return view('toppage'); 
   return redirect()->route('login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/search',  [SearchController::class, 'search'])->name('search');
    Route::get('/search',  [SearchController::class, 'search']);
    Route::post('/get_city',  [ShopcreateController::class, 'getCity'])->name('get_city');
    Route::get('/shop_detail/{id}', [ShopcreateController::class, 'detail'])->name('shop.detail');
});

Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::view('/shop_create', 'shopCreate')->name('shop.create');
    Route::post('/shop_store',  [ShopcreateController::class, 'store'])->name('shop.store');
    Route::get('/shop_edit/{id}', [ShopcreateController::class, 'edit'])->name('shop.edit');
    Route::post('/shop_update',  [ShopcreateController::class, 'update'])->name('shop.update');
    Route::post('/shop_delete',  [ShopcreateController::class, 'delete'])->name('shop.delete');

    Route::get('/shop_category', [ShopcreateController::class, 'shopCategory'])->name('shop.category');
    Route::post('/get_category',  [ShopcreateController::class, 'getCategory'])->name('shop.get_category');
    Route::post('/category_create', [ShopcreateController::class, 'categoryCreate'])->name('shop.category_create');
    Route::post('/category_delete', [ShopcreateController::class, 'categoryDelete'])->name('shop.category_delete');

    Route::get('/shop_area', [ShopcreateController::class, 'areaCreate'])->name('shop.area');
    Route::post('/area_create', [ShopcreateController::class, 'areaStore'])->name('shop.area_create');
    Route::post('/get_area', [ShopcreateController::class, 'getArea'])->name('shop.get_area');
    Route::post('/area_delete', [ShopcreateController::class, 'areaDelete'])->name('shop.area_delete');

    Route::post('/phone_create', [ShopcreateController::class, 'phoneCreate'])->name('phone.store');
    Route::post('/phone_update', [ShopcreateController::class, 'phoneUpdate'])->name('phone.update');
    Route::post('/phone_delete', [ShopcreateController::class, 'phoneDelete'])->name('phone.delete');
    Route::post('/phone_get', [ShopcreateController::class, 'phoneGet'])->name('phone.get');
    Route::get('/phone_list', [ShopcreateController::class, 'phonelist'])->name('phone.edit');

    Route::post('/image_delete', [ShopcreateController::class, 'imageDelete'])->name('image.delete');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
