<?php

namespace App\Http\Livewire;


use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $quizz_id, $student_id, $data, $counter = 0, $questioncount = 0;



public function mount($quizz_id, $student_id)
    {
        $this->quizz_id = $quizz_id;
        $this->student_id = $student_id;
    }


    public function render()
    {
        $this->data = Question::where('quizz_id', $this->quizz_id)->get();
        return view('components.⚡-show-question', ['data' => $this->data]);
    }



    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('quizz_id', $this->quizz_id)
            ->first();
        // insert
        if ($stuDegree == null) {
            $degree = new Degree();
            $degree->quizz_id = $this->quizz_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;
            if (strcmp(trim($answer), trim($right_answer)) === 0) {
                $degree->score += $score;
            } else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();
        } else {

            // update
            if ($stuDegree->question_id >= $this->data[$this->counter]->id) {
                $stuDegree->score = 0;
                $stuDegree->abuse = '1';
                $stuDegree->save();
                toastr()->error(trans('message.error'));
            return redirect()->route('student_exam.index');
                
            } else {

                $stuDegree->question_id = $question_id;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $stuDegree->score += $score;
                } else {
                    $stuDegree->score += 0;
                }
                $stuDegree->save();
            }
        }

        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        } else {
            toastr()->success(trans('message.sucess_quizz'));
            return redirect()->route('student_exam.index');
        }

    }


}