<?php
namespace App\Repository;

use App\Models\Question;
use App\Models\Quizz;

class QuestionRepository implements QuestionRepositoryInterface{
    // index
    public function index(){
        $questions = Question::all();
        return view('questions.index',compact('questions'));
    }

    // create 
    public function create(){
        $quizzes = Quizz::all();
        return view('questions.create',compact('quizzes'));
    }

    // store
    public function store($request){
        try {
        $question = new Question();
        $question->title = $request->title;
        $question->answer = $request->answer;
        $question->right_answer = $request->right_answer;
        $question->score = $request->score;
        $question->quizz_id = $request->quizz_id;
        $question->save();
        
        toastr(trans('message.success'));
        return redirect()->route('question.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        
    }

    // edit
    public function edit($id){
        $question = Question::findOrFail($id);
        $quizzes = Quizz::all();
        return view('questions.edit',compact('question','quizzes'));
    }

    // update
    public function update($request){
         try {
        $question = Question::findOrFail($request->id);
        $question->title = $request->title;
        $question->answer = $request->answer;
        $question->right_answer = $request->right_answer;
        $question->score = $request->score;
        $question->quizz_id = $request->quizz_id;
        $question->save();
        
        toastr(trans('message.update'));
        return redirect()->route('question.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // destroy
    public function destroy($request){
        try {
            Question::destroy($request->id);
        toastr(trans('message.delete'));
        return redirect()->route('question.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
            
        }
    }
}