<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Cache;

class StudentController extends Controller
{
    public function index()
    {
        // Try to get data from Redis cache
        $students = Cache::remember('students', 60, function () {
            // Fetch data from the database if not in cache
            return Student::all();
        });

        return response()->json($students);
    }
}
