<?php
    use App\Journal;

    Route::prefix('journals')->group(function() {
        /**
         * Retrieve all Journals
         */
        Route::get('', function(Request $request) {
            return Journal::all();
        });
    });
