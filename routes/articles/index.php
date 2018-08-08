<?php
    use App\Article;

    Route::prefix('articles')->group(function() {
        /**
         * Retrieve all Articles
         */
        Route::get('', function(Request $request) {
            // for ($i = 0; $i < 250; $i++) Article::create([
            //     'title' => 'Article ' . $i,
            //     'user_id' => 1,
            //     'organization_id' => 1,
            //
            //     'journal_id' => 1,
            // ]);

            return Article::limit(100)->get();
        });
    });
