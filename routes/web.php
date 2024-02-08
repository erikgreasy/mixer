<?php

use App\Models\Mix;
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
    return view('welcome', [
        'mixes' => Mix::query()->published()->orderByDesc('published_at')->get(),
    ]);
});

Route::get('mix/{mix}', function (Mix $mix) {
    if (!$mix->isPublished()) {
        abort(404);
    }

    return view('mixes.show', [
        'mix' => $mix
    ]);
})
    ->name('mixes.show');
