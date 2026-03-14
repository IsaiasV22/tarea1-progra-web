<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers.index');
Route::get('/publishers/{id}', [PublisherController::class, 'show'])->name('publishers.show');
