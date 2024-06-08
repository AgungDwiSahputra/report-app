<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ReportController;
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
Route::get('/login', [PageController::class, 'login'])->name('page.login');
Route::get('/forgot-password', [PageController::class, 'forgot_password'])->name('page.forgot-password');
Route::get('/change-password', [PageController::class, 'change_password'])->name('page.change-password');

// Report
Route::get('/page/profile', [PageController::class, 'profile'])->name('page.profile');
Route::resource('/page/report', ReportController::class);
Route::get('/page/report/{report}/document', [ReportController::class, 'add_document'])->name('report.add_document');
Route::get('/page/show-index', [ReportController::class, 'show_index'])->name('report.show-index');
Route::get('/page/show-other-index', [ReportController::class, 'show_other_index'])->name('report.show-other-index');
Route::get('/page/show-other-index/{report}/document', [ReportController::class, 'other_document_completion'])->name('report.other-document-completion');

// Letter
Route::get('/page/create-letter', [PageController::class, 'create_letter'])->name('page.create-letter');
Route::get('/page/show-letter', [PageController::class, 'show_letter'])->name('page.show-letter');
Route::get('/page/show-other-document-letter', [PageController::class, 'show_other_document_letter'])->name('page.show-other-document-letter');
Route::get('/page/list-anggota', [PageController::class, 'list_anggota'])->name('page.list-anggota');
