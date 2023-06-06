<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RevisorController;

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

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

Route::get('/categoria/{category}', [PublicController::class, 'categoryShow'])
    ->name('categoryShow');

Route::get('/regione/{region}', [PublicController::class, 'regionShow'])->name('regionShow');

Route::get("/products/index", [ProductController::class, "index"])->name("products.index");

Route::get('/dettaglio/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get("/user/indexProdotti", [ProductController::class, "userProdotti"])->name("user.indexProdotti");

Route::get('/user/prodotto/{id}', [ProductController::class, 'userProdDettaglio'])->name('user.prodottoDettaglio');

Route::middleware(["isRevisor"])->group(function () {

    Route::get("/revisor/home", [RevisorController::class, "index"])->name("revisor.index");

    Route::patch("/accetta/prodotto/{product}", [RevisorController::class, "acceptProduct"])->name("revisor.accept_product");

    Route::patch("/rifiuta/prodotto/{product}", [RevisorController::class, "rejectProduct"])->name("revisor.reject_product");

    Route::get('/revisor/prodotto/{id}', [RevisorController::class, 'productDetail'])->name('revisor.prodottoDettaglio');
});

Route::middleware(["auth"])->group(function () {

    Route::get("/products/create", [ProductController::class, "create"])->name("product.create");

    Route::get("/richiesta/revisore", [RevisorController::class, "becomeRevisor"])->name("become.revisor");

    Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
});

Route::get("/rendi/revisore/{user}", [RevisorController::class, "makeRevisor"])->name("make.revisor");

Route::get("/products/search", [PublicController::class, "searchProducts"])->name("products.search");

Route::post("/lingua/{lang}", [PublicController::class, "setLanguage"])->name("set_language_locale");
