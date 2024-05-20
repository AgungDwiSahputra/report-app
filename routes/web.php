<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'login'])->name('index');
Route::get('/login', [PageController::class, 'login'])->name('login.index');

Route::get('/page/profile', [PageController::class, 'profile'])->name('page.profile');
Route::get('/page/create-report', [PageController::class, 'create_report'])->name('page.create-report');
Route::get('/page/show-report', [PageController::class, 'show_report'])->name('page.show-report');
Route::get('/page/show-other-document-report', [PageController::class, 'show_other_document_report'])->name('page.show-other-document-report');
Route::get('/page/create-letter', [PageController::class, 'create_letter'])->name('page.create-letter');
Route::get('/page/show-letter', [PageController::class, 'show_letter'])->name('page.show-letter');
Route::get('/page/show-other-document-letter', [PageController::class, 'show_other_document_letter'])->name('page.show-other-document-letter');
Route::get('/page/list-anggota', [PageController::class, 'list_anggota'])->name('page.list-anggota');
