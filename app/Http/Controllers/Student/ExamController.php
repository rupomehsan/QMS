<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\Subject;
use App\Models\User;
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
    public function getAllExamByStudentID($id)
    {

        try {
            $userId = $id;
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
    public function getExamResultByStudentID($id, $stdID)
    {

        try {
            $questions = Question::with(['subject:id,name'])->where('subject_id', $id)->select(['id', 'question', 'subject_id', 'options', 'answer'])->get();
            $result = ExamResult::where("user_id", $stdID)->where("subject_id", $id)->select('answers', 'result')->first();
            $studentInfo = User::where("id", $stdID)->select('user_name')->first();
            return response([
                'status' => "success",
                "data" => $questions,
                "result" => $result,
                "studentInfo" => $studentInfo,
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


        // dd($data['answer']);

        if (!array_key_exists('answer', $data)) {
            return response([
                "status" => "error",
                "message" => "Please select all the answers to the following questions."
            ], 401);
        }

        if (array_key_exists('answer', $data)) {
            $totalQ = Question::where("subject_id", $data['subject_id'])->count();
            if ($totalQ !== count($data['answer'])) {
                return response([
                    "status" => "error",
                    "message" => "Please select the all  answer of the following questions"
                ], 401);
            }
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
