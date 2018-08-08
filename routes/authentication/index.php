<?php
    Route::get('signUp', 'Authentication\RegisterController@signUp')->name('signUp');
    Route::match(['GET', 'POST'], 'signIn', 'Authentication\LoginController@signIn')->name('signIn');
    Route::match(['GET', 'POST'], 'signInJWT', 'Authentication\LoginController@signInJWT')->name('signInJWT');
    Route::get('signOut', 'Authentication\LoginController@signOut')->name('signOut');
