<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Question;
use App\Models\Subject;

class SubjectController extends Controller
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
                'name',
                'status'
            ];

            $condition = [];
            $with = [];
            $queries = Subject::query();

            if (request()->has('fields') && request()->input('fields')) {
                $fields = request()->input('fields');
            }
            if (request()->has('status') && request()->input('status')) {
                $condition['status'] = request()->input('status');
            }
            if (request()->has('search') && request()->input('search')) {
                $queries = $queries->where('name', 'like', '%' . request()->input('search') . '%');
            }

            if (request()->has('get_all')) {
                $queries = $queries->with($with)->select($fields)->where($condition)->get();
            } else {

                $queries = $queries->with($with)->select($fields)->where($condition)->latest()->paginate(5);
            }


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
    public function store(SubjectRequest $request)
    {
        try {
            if (Subject::query()->create($request->validated())) {
                return response([
                    "status" => "success",
                    "message" => "Subject successfully added"
                ], 200);
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
                'name',
                'status'
            ];
            if (!$query = Subject::query()->select($fields)->where(['id' => $id])->first()) {
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
    public function update(string $id, SubjectRequest $request)
    {
        try {
            // dd($request->all());
            if (!$query = Subject::query()->where(["id" => $id])->first()) {
                return response([
                    "status" => "error",
                    "message" => "No configure found..."
                ], 404);
            }
            $query->update($request->validated());
            return response([
                "status" => "success",
                "message" => "Subject successfully update"
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

            if (!$query = Subject::query()->where(["id" => $id])->first()) {
                return response([
                    "status" => "error",
                    "message" => "No configure found..."
                ], 404);
            }
            $questions = Question::query()->where('subject_id', $id);
            if ($query->delete()) {
                $questions->delete();
            }
            return response([
                "status" => "success",
                "message" => "Subject successfully delete"
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
                    $target = Subject::where('id', $item)->first();
                    $target->status = "active";
                    $target->update();
                }
            } else if ($request->actions === "inactive") {
                foreach ($request->itemList as $item) {
                    $target = Subject::where('id', $item)->first();
                    $target->status = "inactive";
                    $target->update();
                }
            } else if ($request->actions === "delete") {

                foreach ($request->itemList as $item) {
                    $target = Subject::where('id', $item)->first();
                    $question = Question::query()->where('subject_id', $item);
                    if ($target->delete()) {
                        $question->delete();
                    }
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
