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
            Article::create([
                'title' => 'ASD',
                'journal_id' => 1,
                'user_id' => 1,
                'organization_id' => 1,
            ]);
        });
    });
