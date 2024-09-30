<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = 'احمد علی بی خویش';

    $query = \App\Models\User::select(['id', 'username', 'first_name', 'last_name']);

    $array = explode(' ', $name);

    foreach ($array as $search)
        $query->whereAny(['username', 'first_name', 'last_name'], 'like', "%$search%");
});
