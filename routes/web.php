<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about-us');

Route::get('/services', [FrontendController::class, 'services'])->name('services.index');
Route::get('/services/{slug}', [FrontendController::class, 'showService'])->name('services.show');
Route::get('/load-more-services', [FrontendController::class, 'loadMoreService'])->name('services.loadMore');

Route::get('/generate-slug', [CategoryController::class, 'generateSlug'])->name('generate-slug');

Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [FrontendController::class, 'submitContactForm'])->name('contact.submit');

Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('newsletter.subscribe');

