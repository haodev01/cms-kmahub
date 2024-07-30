<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    //

    public function getAll(Request $request)
    {
        //
        $courses = Course::all();
        return response()->json([
            "message" => "success",
            "data"=> $courses,
            "status" => 200
        ]);
    }
    public function detail ($slug)
    {
        //
        $course = Course::where('slug', $slug)->with(['requirements', 'benefits', 'sections.lessons'])->first();
        return response()->json([
            "message" => "success",
            "data"=> $course,
            "status" => 200
        ]);
    }
}
