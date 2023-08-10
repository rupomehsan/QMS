<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $fields = [
                'id',
                'user_name',
                'email',
                'phone',
                'status'
            ];


            $condition = [];
            $with = [];
            $queries = User::query(); 

            if (request()->has('get_all')) {
                $queries = $queries->where('dummy_user', 1)->get();
                return response([
                    "status" => "success",
                    "data" => $queries
                ], 200);
            }

            if (request()->has('fields') && request()->input('fields')) {
                $fields = request()->input('fields');
            }
            if (request()->has('status') && request()->input('status')) {
                $condition['status'] = request()->input('status');
            }

            if (auth()->user()->is_Admin == '1') {
                $condition['is_Admin'] = 0;
            }

            if (request()->has('search') && request()->input('search')) {
                $queries = $queries->where('user_name', 'like', '%' . request()->input('search') . '%');
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
    public function store(AuthRequest $request)
    {
        try {
            if (User::query()->create($request->validated())) {
                return response([
                    "status" => "success",
                    "message" => "Student successfully added"
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
                'user_name',
                'email',
                'phone',
                'status'
            ];
            if (!$query = User::query()->select($fields)->where(['id' => $id])->first()) {
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
    public function update(string $id, AuthRequest $request)
    {

        try {
            if (!$query = User::query()->where(["id" => $id])->first()) {
                return response([
                    "status" => "error",
                    "message" => "No configure found..."
                ], 404);
            }
            $query->update($request->validated());
            return response([
                "status" => "success",
                "message" => "Student successfully update"
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

            if (!$query = User::query()->where(["id" => $id])->first()) {
                return response([
                    "status" => "error",
                    "message" => "No configure found..."
                ], 404);
            }
            $query->delete();
            return response([
                "status" => "success",
                "message" => "Student successfully delete"
            ], 200);
        } catch (\Exception $e) {
            return response([
                "status" => 'server_error',
                "data" => $e->getMessage()
            ], 500);
        }
    }
}
