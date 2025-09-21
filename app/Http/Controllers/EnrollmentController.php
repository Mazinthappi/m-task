<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User; // users are students
use App\Models\Enrollment;
use Exception;

class EnrollmentController extends Controller
{
    public function enroll(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);
        $userId = auth()->id();
        try {
            $enrollment = Enrollment::Create([
                'user_id'   => $userId,
                'course_id' => $request->course_id,
            ]);
            return response()->json(['status'  => true, 'message' => 'You have been enrolled successfully', 'data'    => $enrollment]);
        } catch (Exception $e) {
            return response()->json(['status'  => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function myCourses()
    {
        $user = User::with('courses')->find(auth()->id());

        if (!$user) {
            return response()->json(['status'  => false, 'message' => 'no data found'], 404);
        }

        return response()->json(['status'  => true, 'courses' => $user->courses]);
    }
}
