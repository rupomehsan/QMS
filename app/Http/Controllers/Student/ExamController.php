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
            $exams = Subject::with('questions')->get();
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
        $result->user_id = $data['user_id'];
        $result->yes_ans = $rightAns;
        $result->no_ans = $rongAns;
        $result->result = $rightAns . "/" . $titlaQ;
        $result->save();
    }
}
