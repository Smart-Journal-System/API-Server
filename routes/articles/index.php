<?php
    use App\Article;

    Route::prefix('articles')->group(function() {
        /**
         * Retrieve all Articles
         */
        Route::get('', function(Request $request) {
            return Article::paginate(100);
        });

        Route::get('{articleId}', function($articleId) {
            return Article::where('id', '=', $articleId)->first();
        });
    });
