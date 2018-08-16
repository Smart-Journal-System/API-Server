<?php

use Illuminate\Http\Request;

use App\Journal;

$appPath = app_path();

require($appPath . '/../routes/authentication/index.php');
require($appPath . '/../routes/organizations/index.php');
require($appPath . '/../routes/articles/index.php');
require($appPath . '/../routes/journals/index.php');
