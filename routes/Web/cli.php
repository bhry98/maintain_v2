<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\auth\cli as auth;
use App\Http\Controllers\web\dash\cli as dash;
use App\Http\Controllers\web\task\cli as task;

Route::get('/', function () {
    return view('welcome');
});


Route::group(
    [
        'prefix' => 'Client',
        'as' => 'cli.auth.',
        'middleware' => [
            'web',
            // '',
        ],
    ],
    function () {
        Route::get('/Block', [auth::class, 'Block'])->middleware('auth.block.cli')->name('Block');
        Route::get('/Logout', [auth::class, 'Logout'])->name('Logout');
        Route::get('/Login', [auth::class, 'ViewLogin'])->middleware('auth.page')->name('ViewLogin');
        Route::post('/Login', [auth::class, 'Login'])->middleware('auth.page')->name('Login');
    }
);

//

Route::group(
    [
        'prefix' => 'Client',
        'as' => 'cli.',
        'middleware' => [
            'web',
            'auth.cli',
        ],
    ],
    function () {
        Route::get('/Dashboard', [dash::class, 'ViewDash'])->name('dash');
        Route::group(
            [
                'prefix' => 'Task',
                'as' => 'task.',
                'middleware' => [
                    // 'web',
                    // 'auth.cli',
                ],
            ],
            function () {
                Route::get('/Add', [task::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [task::class, 'Add'])->name('Add');
                Route::post('/Add-Rate', [task::class, 'AddRate'])->name('AddRate');
                Route::get('/All', [task::class, 'All'])->name('All');
                Route::get('{id}/Details', [task::class, 'Details'])->name('Details');

            }
        );
    }
);
