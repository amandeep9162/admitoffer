<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loc\Country;
use App\Models\CountryQuestion;
use App\Models\Question;
use Validator;
use Session;

class StudentQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentQuestions = CountryQuestion::with(['country','question'])->get();
        return view('admin.studentQuestions.studentQuestions',compact('studentQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $questions = Question::get();
        return view('admin.studentQuestions.addStudentQuestion',compact('countries','questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  $this->validate($request,
        [
            'country_id' => 'required',
            'question_id' => 'required',
        ]
        );
        CountryQuestion::create([
            'country_id'=>$request->country_id,  
            'question_id'=>$request->question_id,  
            ]);
            Session::flash('success','New Question created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $studentQuestion =CountryQuestion::where('id',$id)->first();
        $countries = Country::all();
        $questions = Question::get();
        return view('admin.studentQuestions.editStudentQuestions',compact('studentQuestion','countries','questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  $this->validate($request,
        [
            'country_id' => 'required',
            'question_id' => 'required',
        ]
        );
        CountryQuestion::where('id',$id)->update([
            'country_id'=>$request->country_id,  
            'question_id'=>$request->question_id,  
            ]);
            Session::flash('success','Question updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getQuestions($id)
    {
        $studentQuestions = CountryQuestion::with(['country','question'])->where('country_id',$id)->get();
         return $studentQuestions;
    }
}
