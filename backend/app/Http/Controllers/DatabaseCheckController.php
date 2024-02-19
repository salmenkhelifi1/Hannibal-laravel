<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatabaseCheckController extends Controller
{
    public function checkConnection()
    {
        try {
            DB::connection()->getPdo();
            return "Connected successfully to the database.";
        } catch (\Exception $e) {
            return "Could not connect to the database. Error: " . $e->getMessage();
        }
    }
}
