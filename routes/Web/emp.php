<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\auth\emp as auth;
use App\Http\Controllers\web\dash\emp as dash;
use App\Http\Controllers\web\role\emp as role;
use App\Http\Controllers\web\ws\emp as ws;
use App\Http\Controllers\web\emp\emp as emp;
use App\Http\Controllers\web\dep\emp as dep;
use App\Http\Controllers\web\cli\emp as cli;
use App\Http\Controllers\web\task\emp as task;
use App\Http\Controllers\web\pur\emp as pur;
use App\Http\Controllers\web\mach\emp as mach;

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

Route::group(
    [
        'prefix' => 'Maintain',
        'as' => 'emp.auth.',
        'middleware' => [
            'web',
            // '',
        ],
    ],
    function () {
        Route::get('/Block', [auth::class, 'Block'])->middleware('auth.block.emp')->name('Block');
        Route::get('/Logout', [auth::class, 'Logout'])->name('Logout');
        Route::get('/Login', [auth::class, 'ViewLogin'])->middleware('auth.page')->name('ViewLogin');
        Route::post('/Login', [auth::class, 'Login'])->middleware('auth.page')->name('Login');
    }
);

Route::group(
    [
        'prefix' => 'Maintain',
        'as' => 'emp.',
        'middleware' => [
            'web',
            'auth.emp',
        ],
    ],
    function () {
        Route::get('/Dashboard', [dash::class, 'ViewDash'])->name('dash');
        // Role
        // Route::view('boostrap-modal','livewire.modal.task.move');

        Route::group(
            [
                'prefix' => 'Role',
                'as' => 'role.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [role::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [role::class, 'Add'])->name('Add');
                Route::get('/{code}/Edit', [role::class, 'ViewEdit'])->name('ViewEdit');
                Route::post('/{code}/Edit', [role::class, 'Edit'])->name('Edit');
                Route::get('/All', [role::class, 'All'])->name('All');
                Route::get('/{code}/Details', [role::class, 'Detail'])->name('Detail');
                Route::get('/Edit-Employee', [role::class, 'ViewChengRoleEmp'])->name('ViewChengRoleEmp');
                Route::get('/Edit-Client', [role::class, 'ViewChengRoleCli'])->name('ViewChengRoleCli');
                Route::post('/Edit-Role', [role::class, 'ChengRole'])->name('ChengRole');
            }
        );
        // Work Shop
        Route::group(
            [
                'prefix' => 'Workshop',
                'as' => 'ws.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [ws::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [ws::class, 'Add'])->name('Add');
                Route::get('/{code}/Edit', [ws::class, 'ViewEdit'])->name('ViewEdit');
                Route::post('/{code}/Edit', [ws::class, 'Edit'])->name('Edit');
                Route::get('/All', [ws::class, 'All'])->name('All');
                Route::get('/{code}/Details', [ws::class, 'Detail'])->name('Detail');
            }
        );
        // Employee
        Route::group(
            [
                'prefix' => 'Employee',
                'as' => 'emp.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [emp::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [emp::class, 'Add'])->name('Add');
                Route::get('/{code}/Edit', [emp::class, 'ViewEdit'])->name('ViewEdit');
                Route::post('/{code}/Edit', [emp::class, 'Edit'])->name('Edit');
                Route::get('/All', [emp::class, 'All'])->name('All');
                Route::get('/{code}/Details', [emp::class, 'Detail'])->name('Detail');
            }
        );
        // Department
        Route::group(
            [
                'prefix' => 'Department',
                'as' => 'dep.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [dep::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [dep::class, 'Add'])->name('Add');
                Route::get('/{code}/Edit', [dep::class, 'ViewEdit'])->name('ViewEdit');
                Route::post('/{code}/Edit', [dep::class, 'Edit'])->name('Edit');
                Route::get('/All', [dep::class, 'All'])->name('All');
                Route::get('/{code}/Details', [dep::class, 'Detail'])->name('Detail');
            }
        );
        // Client
        Route::group(
            [
                'prefix' => 'Client',
                'as' => 'cli.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [cli::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [cli::class, 'Add'])->name('Add');
                Route::get('/{code}/Edit', [cli::class, 'ViewEdit'])->name('ViewEdit');
                Route::post('/{code}/Edit', [cli::class, 'Edit'])->name('Edit');
                Route::get('/All', [cli::class, 'All'])->name('All');
                Route::get('/{code}/Details', [cli::class, 'Detail'])->name('Detail');
            }
        );
        // Pur
        Route::group(
            [
                'prefix' => 'Pur',
                'as' => 'pur.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [pur::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [pur::class, 'Add'])->name('Add');
                // Route::get('/{code}/Edit', [pur::class, 'ViewEdit'])->name('ViewEdit');
                Route::post('/{code}/Action', [pur::class, 'Action'])->name('Action');
                Route::get('/All', [pur::class, 'All'])->name('All');
                Route::get('/{code}/Details', [pur::class, 'Details'])->name('Details');
            }
        );
        // Machine
        Route::group(
            [
                'prefix' => 'Machine',
                'as' => 'mach.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [mach::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [mach::class, 'Add'])->name('Add');
                // Route::get('/{code}/Edit', [mach::class, 'ViewEdit'])->name('ViewEdit');
                Route::post('/{code}/Action', [mach::class, 'Action'])->name('Action');
                Route::get('/All', [mach::class, 'All'])->name('All');
                Route::get('/{code}/Details', [mach::class, 'Details'])->name('Details');
            }
        );
        // Task
        Route::group(
            [
                'prefix' => 'Task',
                'as' => 'task.',
                'middleware' => [
                    // 'web',
                    // 'auth.emp',
                ],
            ],
            function () {
                Route::get('/Add', [task::class, 'ViewAdd'])->name('ViewAdd');
                Route::post('/Add', [task::class, 'Add'])->name('Add');
                Route::post('/MoveToWS', [task::class, 'MoveToWS'])->name('MoveToWS');
                Route::post('/AppToMy', [task::class, 'AppToMy'])->name('AppToMy');
                Route::post('/End', [task::class, 'End'])->name('End');
                Route::get('/Work-Shop', [task::class, 'AllMyWsTask'])->name('AllMyWsTask');
                Route::get('/{code}/Details', [task::class, 'Details'])->name('Detail');
                Route::get('/All', [task::class, 'All'])->name('All');



                // Route::get('/{code}/Edit', [task::class, 'ViewEdit'])->name('ViewEdit');
                // Route::post('/{code}/Edit', [task::class, 'Edit'])->name('Edit');
            }
        );
    }
);
// Route::get('/role', function () {
//     return view('role.add.emp');
// });
