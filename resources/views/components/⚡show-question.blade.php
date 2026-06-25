<?php

use Livewire\Component;
use App\Models\Question;
use App\Models\Degree;


new class extends Component {
    public $quizz_id, $student_id, $data, $counter = 0, $questioncount = 0;

    public function mount($quizz_id, $student_id)
    {
        $this->quizz_id = $quizz_id;
        $this->student_id = $student_id;
        $this->data = Question::where('quizz_id', $this->quizz_id)->get();
        $this->questioncount = $this->data->count();

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

};
?>

<div>
    <div>
        <div>
            <div class="card card-statistics mb-30">
                <div class="card-body">
                    @if(isset($data[$counter]))
                        <h5 class="card-title">{{ $data[$counter]->title }}</h5>



                        @foreach(preg_split('/(-)/', $data[$counter]->answer) as $index => $answer)
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio{{$index}}" name="customRadio" class="custom-control-input"
                                    inh>
                                <label class="custom-control-label" for="customRadio{{$index}}"
                                    wire:click="nextQuestion({{$data[$counter]->id}}, {{$data[$counter]->score}}, '{{$answer}}', '{{$data[$counter]->right_answer}}')">
                                    {{$answer}}</label>
                            </div>
                        @endforeach

                    @endif

                </div>
            </div>
        </div>