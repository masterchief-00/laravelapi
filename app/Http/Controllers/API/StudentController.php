<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function updateStudent(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'course' => 'required|max:191',
            'phone' => 'required|string|digits_between:10,12'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validate_error' => $validator->errors(),
            ]);
        } else {
            $student = Student::find($id);
            if ($student) {
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
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => "Student ID not found"
                ]);
            }
        }
    }
    public function editStudent($id)
    {
        $student = Student::find($id);

        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Student ID not found"
            ]);
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'course' => 'required|max:191',
            'phone' => 'required|string|digits_between:10,12'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validate_error' => $validator->errors(),
            ]);
        } else {
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
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Student deleted!'
        ]);
    }
}
