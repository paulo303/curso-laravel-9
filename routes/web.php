<?php

use App\Http\Controllers\{
    UserController,
    PreferenceController,
};
use App\Models\Preference;
use App\Models\User;
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

Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/preferences', function() {
    $user = User::with('preference')->find(1);
    dd($user);
    $data = [
        'background_color' => '#030',
    ];

    if ($user->preference) {
        $user->preference->update($data);
    } else {
        $user->preference()->create($data);
        // $preference = new Preference($data);
        // $user->preference()->save($preference);
    }

    $user->refresh();

    dd($user);
});


Route::get('/', function () {
    return view('welcome');
});
