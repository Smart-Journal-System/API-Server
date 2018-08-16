<?php
    use App\User;
    use App\Organization;

    Route::prefix('organizations')->group(function() {
        /**
         * Retrieve all Articles
         */
        Route::get('', function(Request $request) {
            return Organization::paginate(100);
        });

        Route::get('{organizationId}', function($organizationId) {
            return Organization::where('id', '=', $organizationId)->first();
        });
    });
