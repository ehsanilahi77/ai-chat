<?php

use App\Http\Controllers\StreamController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::livewire('/chat', 'pages::chat')->name('chat');

Route::post('/chat/stream', StreamController::class)->name('chat.stream');
