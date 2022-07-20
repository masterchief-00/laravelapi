<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function updateStudent(Request $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->course = $request->input('course');
        $student->phone = $request->input('phone');
        $student->update();

        return response()->json([
            'status' => 200,
            'message' => 'Student updated!'
        ]);
    }
    public function editStudent($id)
    {
        $student = Student::find($id);

        return response()->json([
            'status' => 200,
            'student' => $student
        ]);
    }

    public function index()
    {
        $students = Student::all();

        return response()->json([
            'status' => 200,
            'students' => $students
        ]);
    }
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->course = $request->input('course');
        $student->phone = $request->input('phone');
        $student->save();

        return response()->json([
            'status' => 200,
            'message' => 'Student added'
        ]);
    }
}
