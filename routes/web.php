<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
    return view('/auth.login');
});

Route::middleware(['auth.redirect'])->group(function () {

    Route::get('/redirects',[HomeController::class,"index"]);

    Route::get('/dashboard', function () {
        return view('dashboard');
            })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/application/add', [ApplicationController::class, 'add'])->name('application.add');
Route::get('/application/create/{nic?}', [ApplicationController::class, 'create'])->name('application.create');
Route::get('/application/view/{id?}', [ApplicationController::class, 'view'])->name('application.view');
Route::post('/application/store', [ApplicationController::class, 'store'])->name('application.store');
Route::post('/application/storepdf/{application_id}', [ApplicationController::class, 'storepdf'])->name('application.pdf2');
Route::get('/application/search', [ApplicationController::class, 'search'])->name('application.search');
Route::get('/application/vieweach/{application_id}', [ApplicationController::class, 'vieweach'])->name('application.each');
Route::post('/application/inactive', [ApplicationController::class, 'inactive'])->name('application.inactive');
Route::put('/update-pdf2/{application_id}', [ApplicationController::class]);
Route::get('/pdf/view/{id}/{pdf_path}', [PdfController::class, 'view'])->name('pdf.view');


Route::get('/application/inactivelist', [ApplicationController::class, 'inactivelist'])->name('application.inactivelist');
Route::get('/application/vieweachinactive/{application_id}', [ApplicationController::class, 'vieweachinactive'])->name('application.eachinactive');
Route::post('/application/notinactive', [ApplicationController::class, 'notinactive'])->name('application.notinactive');
Route::post('/application/appinactive', [ApplicationController::class, 'appinactive'])->name('application.appinactive');


Route::get('/application/inactivedApp', [ApplicationController::class, 'inactivedApp'])->name('application.inactivedApp');
Route::get('/application/eachinactivated/{application_id}', [ApplicationController::class, 'eachinactivated'])->name('application.eachinactivated');


Route::get('/letter/search',[LetterController::class, 'search'])->name('letter.search');
Route::get('/letter/add', [LetterController::class, 'add'])->name('letter.add');
Route::get('/letter/view/{id?}', [LetterController::class, 'view'])->name('letter.view');
Route::get('/letter/create/{nic?}', [LetterController::class, 'create'])->name('letter.create');
Route::post('/letter/store', [LetterController::class, 'store'])->name('letter.store');



Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

});


require __DIR__.'/auth.php';

