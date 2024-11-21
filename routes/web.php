<?php

use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VerifyEmailController;
use App\Notifications\TestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Auth::routes(['verify' => true]);

Route::get('/', fn () => view('pages.landing'))->name('home');

Route::prefix('email')->middleware('auth')->group(function () {
//    Notify user for email verification
    Route::view('/verify', 'auth.verify')->name('verification.notice');

    Route::get('/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware('signed')->name('verification.verify');

    Route::post('/verification-notification', [VerifyEmailController::class, 'notifyUser'])->middleware('throttle:6,1')->name('verification.send');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [ReminderController::class, 'index'])->name('/');

    Route::view('/reminder-option', 'pages/reminders/reminder-option')->name('option');

    Route::resource('reminders', ReminderController::class)->except(['index']);

    Route::controller(ReminderController::class)->prefix('reminders')->name('reminders.')->group(function () {
        Route::post('/option', 'saveOption')->name('save-option');
        Route::patch('/toggle/{reminder}', 'toggleReminder')->name('toggle');
    });

    Route::name('users.')->prefix('users')->controller(UsersController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::get('/delete{user}', 'delete')->name('delete');
    });

    Route::get('/logout', function () {
        Session::flush();
        Auth::logout();
        return redirect('login');
    });
});

Route::get('/send-email', function () {

    $email = request('email', 'johnwebster221@gmail.com');

    Notification::route('mail', $email)->notify(new TestEmail());

    return redirect()->route('/');

});
