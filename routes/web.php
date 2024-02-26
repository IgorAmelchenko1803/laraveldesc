<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\MessageController;
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


Route::middleware(['auth' , 'verified'])->group(function () {
    Route::get('/message/{id}', [MessageController::class, 'showMessage'])->name('show.message');
    Route::get('/create/message', [MessageController::class, 'show'])->name('create.message');
    Route::post('/create/message', [MessageController::class, 'store']);
    Route::get('/edit/messages', [MessageController::class, 'showUserMessages'])->name('show.messages');
    Route::delete('/edit/messages', [MessageController::class, 'destroy']);
    Route::get('/edit/message/{id}', [MessageController::class, 'editMessage'])->name('edit.message');
    Route::post('/edit/message/{id}', [MessageController::class, 'saveEditedMessage']);
    Route::get('/home', [HomeController::class, 'show'])->name('home');
    Route::get('/{categoryId}/{subcategoryId}', [SubcategoryController::class, 'show'])
        ->where([
            'categoryId' => '[0-9]+',     // Ограничение только цифрами
            'subcategoryId' => '[0-9]+',  // Ограничение только цифрами
        ]);
 
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth' , 'admin'])->group(function () {
    Route::delete('/{categoryId}/{subcategoryId}', [MessageController::class, 'destroy'])
        ->where([
            'categoryId' => '[0-9]+',     // Ограничение только цифрами
            'subcategoryId' => '[0-9]+',  // Ограничение только цифрами
        ]);


    Route::get('/admin', [AdminController::class, 'main'])->name('admin.main');
    Route::get('/admin/category/create', [AdminController::class, 'showCreateCategory'])->name('admin.create.category');
    Route::get('/admin/category/edit', [AdminController::class, 'showEditCategory'])->name('admin.edit.category');
    Route::get('/admin/category/delete', [AdminController::class, 'showDeleteCategory'])->name('admin.delete.category');
    Route::post('/admin/category/delete', [AdminController::class, 'destroyCategory']);

    Route::get('/admin/subcategory/create', [AdminController::class, 'showCreateSubcategory'])->name('admin.create.subcategory');
    Route::get('/admin/subcategory/edit', [AdminController::class, 'showEditSubcategory'])->name('admin.edit.subcategory');
    Route::get('/admin/subcategory/delete', [AdminController::class, 'showDeleteSubcategory'])->name('admin.delete.subcategory');
    Route::get('/admin/subcategory/insert', [AdminController::class, 'showInsertSubcategory'])->name('admin.insert.subcategory');

    Route::get('/admin/message/create', [AdminController::class, 'showCreateMessage'])->name('admin.create.message');
    Route::get('/admin/message/edit', [AdminController::class, 'showEditMessage'])->name('admin.edit.message');
    Route::get('/admin/message/delete', [AdminController::class, 'showDeleteMessage'])->name('admin.delete.message');
    

    Route::post('/admin/category/create', [AdminController::class, 'storeCategory']);
    Route::post('/admin/category/edit', [AdminController::class, 'storeEditCategory']);

    Route::post('/admin/subcategory/create', [AdminController::class, 'storeCreateSubcategory']);
    Route::post('/admin/subcategory/edit', [AdminController::class, 'storeEditSubcategory']);
    Route::post('/admin/subcategory/insert', [AdminController::class, 'storeInsertSubcategory']);
});

require __DIR__.'/auth.php';
