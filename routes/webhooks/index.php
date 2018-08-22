<?php

Route::prefix('webhooks')->group(function () {
    /**
     * Interpret and process webhooks from Amazon
     */
    Route::prefix('amazon')->group(function () {

    });

    /**
     * Interpret and process webhooks from Stripe
     */
     Route::prefix('stripe')->group(function () {

     });
});
