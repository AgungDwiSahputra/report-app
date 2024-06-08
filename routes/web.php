<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListAnggotaController;
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
Route::post('/login/process', [AuthController::class, 'login'])->name('post.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('post.logout');

// (level : semua level)
Route::middleware('auth')->group(function () {
    Route::get('/forgot-password', [PageController::class, 'forgot_password'])->name('page.forgot-password');
    Route::get('/change-password/{id_pengguna}', [PageController::class, 'change_password'])->name('page.change-password');
    Route::post('/change-password/{id_pengguna}/process', [AuthController::class, 'change_password'])->name('post.change-password');
    Route::get('/page/profile', [PageController::class, 'profile'])->name('page.profile');
});

// Report (level : babinsa dan danramil)
Route::middleware(['auth', 'level:babinsa,danramil'])->group(function () {
    Route::resource('/page/report', ReportController::class);
    Route::get('/page/report/{report}/document', [ReportController::class, 'add_document'])->name('report.add_document');
    Route::get('/page/show-index', [ReportController::class, 'show_index'])->name('report.show-index');
    Route::get('/page/show-other-index', [ReportController::class, 'show_other_index'])->name('report.show-other-index');
    Route::get('/page/show-other-index/{report}/document', [ReportController::class, 'other_document_completion'])->name('report.other-document-completion');
});

// Letter (level : staf)
Route::middleware(['auth', 'level:staf'])->group(function () {
    Route::get('/page/create-letter', [PageController::class, 'create_letter'])->name('page.create-letter');
    Route::get('/page/show-letter', [PageController::class, 'show_letter'])->name('page.show-letter');
    Route::get('/page/show-other-document-letter', [PageController::class, 'show_other_document_letter'])->name('page.show-other-document-letter');
});

Route::resource('/page/list-anggota', ListAnggotaController::class)->middleware(['auth', 'level:admin']);
