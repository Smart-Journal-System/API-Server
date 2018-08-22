<?php

use Illuminate\Http\Request;

use App\Journal;

$appPath = app_path();

// http://localhost:8000/api/nikki/form

// GET - Retrieve data
// POST - Submit NEW data
// PUT - Update data
// DELETE - Delete data

// OPTIONS - Determine whether domain can communicate with another

// Please place all of your code here!
Route::prefix('nikki')->group(function() {
    Route::post('/form', function(Request $request) {
        // 1.)  Validate your data - I don't care how;
        //      simply ensure that we recieve a title and that the User is logged in
        // 2.)  Create a new Article; assign the Title and the User Id
        // 3.)  Serve back the new Article object as the response

        // Validate here...

        // Create here...

        // Serve here...

        Response::json([
            'status' => true,
            'message' => 'Did you do it yet?'
        ]);
    });
});

require($appPath . '/../routes/authentication/index.php');
require($appPath . '/../routes/organizations/index.php');
require($appPath . '/../routes/articles/index.php');
require($appPath . '/../routes/journals/index.php');
