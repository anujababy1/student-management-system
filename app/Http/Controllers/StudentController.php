<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\StudentInterface;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $student;

    public function __construct(StudentInterface $student)
    {
        $this->student = $student;
    }


    /**
     * Display a list of student.
     *
     * @return Response
     */

    public function index()
    {
        $students = $this->student->all();
        return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers=$this->student->getTeachers();
        return view('students.create',compact('teachers'));
    }

    /**
     * Store a newly created student .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* validation */
        $request->validate([
            'name'=>'required',
            'age'=>'required|integer|min:5|max:20',
            'gender'=>'required',
            'reporting_teacher'=>'required'
        ]);

        /*save */
        $student=$this->student->create([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'reporting_teacher' => $request->reporting_teacher,
        ]);

        return redirect('/students')->with('success', 'Student saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        abort(404);
    }

    /**
     * Show the form for student.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $student = $this->student->find($id);
        $teachers=$this->student->getTeachers();
        return view('students.edit', compact('student','teachers'));    
    }

    /**
     * Update student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   


        /* validation */
        $request->validate([
            'name'=>'required',
            'age'=>'required|integer|min:5|max:20',
            'gender'=>'required',
            'reporting_teacher'=>'required'
        ]);

        /* update */

        $data = [
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'reporting_teacher' => $request->reporting_teacher
        ];

        $student = $this->student->update($data,$id);
        return redirect('/students')->with('success', 'Student updated successfully');
    }

    /**
     * Remove student.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->student->delete($id);
        return redirect('/students')->with('success', 'Student deleted successfully');
    }
}
