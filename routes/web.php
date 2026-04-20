<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\NyotaTech\ClientController;
use App\Http\Controllers\NyotaTech\ContactMessageController;
use App\Http\Controllers\NyotaTech\DashboardController;
use App\Http\Controllers\NyotaTech\DocumentController;
use App\Http\Controllers\NyotaTech\InvoiceController;
use App\Http\Controllers\NyotaTech\ProjectController;
use App\Http\Controllers\NyotaTech\QuotationController;
use App\Http\Controllers\NyotaTech\ReceiptController;
use App\Http\Controllers\NyotaTech\ReportsDashboardController;
use App\Http\Controllers\NyotaTech\SoftwareRequirementSpecController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'nyotatech.public.home')->name('nyotatech.home');
Route::view('/services', 'nyotatech.public.services')->name('nyotatech.services');
Route::view('/about', 'nyotatech.public.about')->name('nyotatech.about');
Route::view('/contact', 'nyotatech.public.contact')->name('nyotatech.contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('nyotatech.contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->prefix('app')->name('nyotatech.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/reports', [ReportsDashboardController::class, 'index'])->name('reports.dashboard');

    Route::resource('clients', ClientController::class)->except(['destroy']);
    Route::resource('projects', ProjectController::class)->except(['destroy']);

    Route::get('quotations/{quotation}/pdf', [QuotationController::class, 'downloadPdf'])->name('quotations.pdf');
    Route::resource('quotations', QuotationController::class)->except(['destroy']);

    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.pdf');
    Route::resource('invoices', InvoiceController::class)->except(['destroy']);

    Route::resource('receipts', ReceiptController::class)->only(['index', 'create', 'store', 'show']);

    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::resource('documents', DocumentController::class)->only(['index', 'create', 'store', 'show']);

    Route::get('srs', [SoftwareRequirementSpecController::class, 'index'])->name('srs.index');
    Route::get('srs/create', [SoftwareRequirementSpecController::class, 'create'])->name('srs.create');
    Route::post('srs', [SoftwareRequirementSpecController::class, 'store'])->name('srs.store');
    Route::get('srs/{software_requirement_spec}', [SoftwareRequirementSpecController::class, 'show'])->name('srs.show');
    Route::get('srs/{software_requirement_spec}/pdf', [SoftwareRequirementSpecController::class, 'downloadPdf'])->name('srs.pdf');
});
