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
        dd($request);
        echo 'Hi Nikki! Process a "form" here.';
    });
});

require($appPath . '/../routes/authentication/index.php');
require($appPath . '/../routes/organizations/index.php');
require($appPath . '/../routes/articles/index.php');
require($appPath . '/../routes/journals/index.php');
