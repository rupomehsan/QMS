<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {



            $offset = request()->input('offset') ?? 10;
            $fields = [
                'id',
                'subject_id',
                'question',
                'options',
                'answer',
                'status'
            ];


            $condition = [];
            $with = ['subject:id,name'];
            $queries = Question::query();

            if (request()->has('fields') && request()->input('fields')) {
                $fields = request()->input('fields');
            }
            if (request()->has('status') && request()->input('status')) {
                $condition['status'] = request()->input('status');
            }
            if (request()->has('search') && request()->input('search')) {
                $queries = $queries->where('question', 'like', '%' . request()->input('search') . '%');
            }

            $queries = $queries->with($with)->select($fields)->where($condition)->latest()->paginate(5);
            return response([
                "status" => "success",
                "data" => $queries
            ], 200);
        } catch (\Exception $e) {
            return response([
                "status" => 'server_error',
                "data" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        try {

            if (!(array_key_exists("options", $request->all()))) {
                return response([
                    "status" => 'error',
                    "message" => "Please add  options"
                ], 401);
            }

            if ((array_key_exists("options", $request->all()))) {
                $lenght = count($request->options);
                if ($lenght < 3) {
                    return response([
                        "status" => 'error',
                        "message" => "Please add minimum 3 options"
                    ], 401);
                }

                foreach ($request['options'] as $option) {
                    if (!$option) {
                        return response([
                            "status" => 'error',
                            "message" => "Options can't be empty"
                        ], 401);
                    }
                }


                if (!(array_key_exists("answer", $request->all()))) {
                    return response([
                        "status" => 'error',
                        "message" => "Please select answer"
                    ], 401);
                }




                if (Question::query()->create($request->validated())) {
                    return response([
                        "status" => "success",
                        "message" => "Question successfully added"
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response([
                "status" => 'server_error',
                "data" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $fields = [
                'id',
                'subject_id',
                'question',
                'options',
                'answer',
                'status'
            ];
            if (!$query = Question::query()->select($fields)->where(['id' => $id])->first()) {
                return response([
                    "status" => "error",
                    "message" => "No configure found..."
                ], 404);
            }

            return response([
                "status" => "success",
                "data" => $query
            ], 200);
        } catch (\Exception $e) {
            return response([
                "status" => 'server_error',
                "data" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, QuestionRequest $request)
    {
        try {
            if (!$query = Question::query()->where(["id" => $id])->first()) {
                return response([
                    "status" => "error",
                    "message" => "No configure found..."
                ], 404);
            }
            $query->update($request->validated());
            return response([
                "status" => "success",
                "message" => "Question successfully update"
            ], 200);
        } catch (\Exception $e) {
            return response([
                "status" => 'server_error',
                "data" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            if (!$query = Question::query()->where(["id" => $id])->first()) {
                return response([
                    "status" => "error",
                    "message" => "No configure found..."
                ], 404);
            }
            $query->delete();
            return response([
                "status" => "success",
                "message" => "Question successfully delete"
            ], 200);
        } catch (\Exception $e) {
            return response([
                "status" => 'server_error',
                "data" => $e->getMessage()
            ], 500);
        }
    }


    public function bulkActions(Request $request)
    {
        try {
            if ($request->actions === "active") {
                foreach ($request->itemList as $item) {
                    $target = Question::where('id', $item)->first();
                    $target->status = "active";
                    $target->update();
                }
            } else if ($request->actions === "inactive") {
                foreach ($request->itemList as $item) {
                    $target = Question::where('id', $item)->first();
                    $target->status = "inactive";
                    $target->update();
                }
            } else if ($request->actions === "delete") {
                foreach ($request->itemList as $item) {
                    $target = Question::where('id', $item)->first();
                    $target->delete();
                }
            }
            return response([
                "status" => "success",
                "message" => "Items successfully " . $request->actions
            ], 200);
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e
            ], 500);
        }
    }
}
