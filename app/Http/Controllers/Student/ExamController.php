<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function getAllExams()
    {
        try {
            $userId = auth()->user()->id;
            $exams = Subject::with(['questions', 'exam_results' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }])->get();
            return response([
                'status' => "success",
                "data" => $exams
            ]);
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e
            ], 500);
        }
    }


    public function getAllQuestionsBySubject($id)
    {
        try {
            $questions = Question::with(['subject:id,name'])->where('subject_id', $id)->select(['id', 'question', 'subject_id', 'options'])->get();

            return response([
                'status' => "success",
                "data" => $questions,

            ]);
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e
            ], 500);
        }
    }

    public function examResultBySubject($id)
    {
        try {
            $questions = Question::with(['subject:id,name'])->where('subject_id', $id)->select(['id', 'question', 'subject_id', 'options', 'answer'])->get();
            $result = ExamResult::where("user_id", auth()->id())->where("subject_id", $id)->select('answers')->first();
            return response([
                'status' => "success",
                "data" => $questions,
                "result" => $result['answers'],
            ]);

            return response([
                'status' => "success",
                "data" => $questions
            ]);
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e
            ], 500);
        }
    }

    public function attemptExam()
    {

        $data = request()->all();
        $rightAns = 0;
        $rongAns = 0;




        if (!array_key_exists('answer', $data)) {
            return response([
                "status" => "error",
                "message" => "Please select the  answer"
            ], 401);
        }


        foreach ($data['answer'] as $questionId => $answer) {
            $q = Question::where("id", $questionId)->first();
            if ($q->answer == $answer) {
                $rightAns++;
            } else {
                $rongAns++;
            }
        }

        $titlaQ = Question::where("subject_id", $data['subject_id'])->count();

        $result = new ExamResult();
        $result->subject_id = $data['subject_id'];
        $result->user_id = auth()->id();
        $result->yes_ans = $rightAns;
        $result->no_ans = $rongAns;
        $result->result = $rightAns . "/" . $titlaQ;
        $result->answers = $data['answer'];


        if ($result->save()) {
            return response([
                'status' => "success",
                "message" => "Successfully submit",
                "redirect" => "/student/profile"
            ], 200);
        }
    }
}
