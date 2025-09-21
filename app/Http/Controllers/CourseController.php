<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function createCourse(CourseRequest $request)
    {
        try {
            $Course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
            if ($Course) {
                return response()->json(['status' => false, 'message' => 'course created successfully']);
            } else {
                return response()->json(['status' => false, 'message' => 'some thing went wrong'], 400);
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getCourse()
    {
        try {
            $data = Course::paginate(25);
            return response()->json(['status' => true, 'message' => 'course list fetched successfully', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function updateCourse(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string',
                'price'       => 'required|numeric|min:0',
            ]);

            $course = Course::find($id);
            if (!$course) {
                return response()->json(['status'  => false, 'message' => 'Data not found',], 404);
            }
            $course->update($validated);
            return response()->json(['status'  => true, 'message' => 'Course updated successfully', 'data'    => $course,]);
        } catch (Exception $e) {
            return response()->json(['status'  => false, 'message' => $e->getMessage(),], 400);
        }
    }
    public function deleteCourse($id)
    {
        try {
            $course = Course::find($id);
            if (!$course) {
                return response()->json(['status'  => false, 'message' => 'Course not found',], 404);
            }
            $course->delete();
            return response()->json(['status'  => true, 'message' => 'Course deleted successfully',]);
        } catch (Exception $e) {
            return response()->json(['status'  => false, 'message' => $e->getMessage(),], 400);
        }
    }
    public function CourseData()
    {
        $userId = Auth::id();

        $courses = Course::withCount('users')
            ->get()
            ->map(function ($course) use ($userId) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'price' => $course->price,
                    'enrolled_students_count' => $course->users_count,
                    'is_enrolled' => $course->users->contains('id', $userId),
                ];
            });

        return response()->json([
            'status' => true,
            'data' => $courses
        ]);
    }
    public function searchCourse(Request $request)
    {
        try {
            $searchKey = $request->key;
            if ($searchKey) {
                $data = course::where('title', 'LIKE', "%{$searchKey}%")->get();
                return response()->json(['status' => true, 'message' => 'data fetched succesfully', 'data' => $data]);
            } else {
                return response()->json(['status' => false, 'message' => 'no data found']);
            }
        } catch (Exception $e) {
            return response()->json(['status'  => false, 'message' => $e->getMessage(),], 400);
        }
    }
}
