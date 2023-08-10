<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function statistics()
    {
        $allUsers = User::where('is_Admin', 0)->count();
        $allSubjects = Subject::count();
        $allQuestion = Question::count();

        return response([
            "status" => "success",
            "data" => [
                "allUsers" => $allUsers,
                "allSubjects" => $allSubjects,
                "allQuestions" => $allQuestion,
            ]
        ]);
    }
}
