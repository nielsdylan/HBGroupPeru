<?php

namespace App\Http\Controllers;

use App\Models\AnswersQuestion;
use App\Models\Question;
use App\Models\QuestionsExam;
use App\Models\TypesQuestion;
use Illuminate\Http\Request;

class QuestionExamController extends Controller
{
    //
    public function questionExam($examen)
    {
        # code...
        $results = QuestionsExam::where('active',1)->where('exam_id',$examen)->get();
        return view('frontend.private.question.index', compact('results','examen'));
    }
    public function index()
    {
        # code...
        $results = QuestionsExam::where('active',1)->get();
        return view('frontend.private.question.index', compact('results'));
    }
    public function create($examen)
    {
        # code...
        $types_inputs = TypesQuestion::where('active',1)->get();
        return view('frontend.private.question.create', compact('examen','types_inputs'));
    }
    public function store(Request $request)
    {
        # code...

        // return $request;
        $question_exam = new QuestionsExam();
        $question_exam->question = $request->question;
        $question_exam->type_question_id = $request->type_question;
        $question_exam->exam_id = $request->exam_id;
        $question_exam->save();

        switch ($request->type_question) {
            case '1':
                foreach ($request->answer as $key => $value) {
                    $answer_question = new AnswersQuestion();
                    $answer_question->answer = $value[0];
                    $answer_question->question_exam_id = $question_exam->question_exam_id ;
                    //cual es la correcta
                    if ($request->answer_check==$key) {
                        $answer_question->value = 1;
                    }else{
                        $answer_question->value = 0;
                    }
                    $answer_question->order_answer = $key;
                    $answer_question->save();

                }
            break;

            case '2':
                foreach ($request->answer as $key => $value) {
                    $answer_question = new AnswersQuestion();
                    $answer_question->answer = $value[0];
                    $answer_question->question_exam_id = $question_exam->question_exam_id ;
                    //cual es la correcta
                    foreach ($request->answer_check as $key_answer => $value_answer) {
                        if ($value_answer == $key) {
                            $answer_question->value = 1;
                        } else {
                            $answer_question->value = 0;
                        }

                    }
                    $answer_question->order_answer = $key;
                    $answer_question->save();

                }
            break;
        }

        return response()->json([
            'success'=>true,
            'status'=>200
        ]);


    }
    public function edit($question)
    {
        # code...
        $question_exam = QuestionsExam::where('active',1)->where('question_exam_id',$question)->first();
        $answers_questions = AnswersQuestion::where('active',1)->where('question_exam_id',$question)->get();
        $types_inputs = TypesQuestion::where('active',1)->get();
        return view('frontend.private.question.edit', compact('question_exam','answers_questions','types_inputs'));
    }
    public function update(Request $request, Question $examan)
    {
        # code...
        $examan->name         = $request->name;
        $examan->description  = $request->description;
        $examan->evaluation   = $request->evaluation;
        $examan->update_by = session('hbgroup')['user_id'];
        $examan->save();
        return redirect()->route('question.index');
    }
    public function show()
    {
        # code...
    }
    public function destroy($examen)
    {
        # code...
        $fecha = date('Y-m-d H:i:s');
        Question::where('active', 1)->where('exam_id', $examen)
        ->update([
            'active' => 0,
            'deleted_at'=>$fecha,
            'update_by'=>session('hbgroup')['user_id'],
            'delete_by'=>session('hbgroup')['user_id']
        ]);
        return response()->json([
            'success'=>true,
            'status'=>200
        ]);
    }
}
