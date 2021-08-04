<?php

namespace App\Http\Controllers;

use App\Mark;
use App\Student;
use Illuminate\Http\Request;
use App\Repositories\MarkRepository;
use App\Repositories\Interfaces\MarkInterface;
use App\Repositories\Interfaces\StudentInterface;
use Illuminate\Validation\Rule;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $mark;

    public function __construct(MarkInterface $mark,StudentInterface $student)
    {
        $this->mark     = $mark;
        $this->student  = $student;
    }

     /**
     * Smark listing.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $marks=$this->mark->all();
        return view('marks.index',compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $students = $this->student->all();
       $terms=$this->student->getTerms();
       return view('marks.create',compact('terms','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $customMessages = [
            'student_id.unique' => 'Student and tearm has to be unique.',
        ];

        $request->validate([
            'student_id' =>  [
                             'required', 
                             Rule::unique('marks')
                                    ->where('term', $request->term)
                            ],
            'maths'=>'required|integer|min:0|max:100',
            'science'=>'required|integer|min:0|max:100',
            'history'=>'required|integer|min:0|max:100',
            'term'=>'required'
        ],$customMessages);

        $mark = $this->mark->create([
            'student_id' => $request->student_id,
            'maths' => $request->maths,
            'science' => $request->science,
            'history' => $request->history,
            'term' => $request->term
        ]);
        return redirect('/marks')->with('success', "Mark saved successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marks  $Marks
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marks  $Marks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terms=$this->student->getTerms();
        $mark=$this->mark->find($id);
        $students = $this->student->all();
        return view('marks.edit', compact('mark','students','terms'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marks  $Marks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $customMessages = [
            'student_id.unique' => 'Student and tearm has to be unique.',
        ];

        $request->validate([
            'student_id' =>  [
                             'required', 
                             Rule::unique('marks')
                                    ->ignore($id)
                                    ->where('term', $request->term)
                            ],
            'maths'=>'required|integer|min:0|max:100',
            'science'=>'required|integer|min:0|max:100',
            'history'=>'required|integer|min:0|max:100',
            'term'=>'required'
         ],$customMessages);

        $mark=$this->mark->update([
            'student_id'=>$request->student_id,
            'maths'=>$request->maths,
            'science'=>$request->science,
            'history'=>$request->history,
            'term'=>$request->term
        ],$id);
        return redirect('/marks')->with('success', "Mark updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mark  $Marks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mark =$this->mark->delete($id);
        return redirect('/marks')->with('success', "Mark deleted successfully");
    }

    public function messages()
    {
        return [
            'student_id.unique' => 'couple username and company_id has to be unique.',
        ];
    }
}
