<?php

use App\Http\Controllers\Eloquent\ManyToManyRelationshipController;
use App\Http\Controllers\Eloquent\PolymorphicRelationshipController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('eloquent')->name('eloquent.')->group(function () {

    Route::prefix('many-to-many-relationship')->name('many-to-many-relationship.')->group(function () {

        Route::get('/', [ManyToManyRelationshipController::class, 'index'])->name('index');

    });

    Route::prefix('polymorphic-relationship')->name('polymorphic-relationship.')->group(function () {

        Route::get('one-to-one', [PolymorphicRelationshipController::class, 'oneToOne'])->name('one-to-one');
        Route::get('one-to-many', [PolymorphicRelationshipController::class, 'oneToMany'])->name('one-to-many');
        Route::get('many-to-many', [PolymorphicRelationshipController::class, 'manyToMany'])->name('many-to-many');

    });

});
