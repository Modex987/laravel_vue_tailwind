<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->input('type');
        if ($type === 'all') {

            return Auth::user()->todos;
        } elseif ($type === 'actif') {

            return Auth::user()->todos()->actif()->get();
        } elseif ($type === 'completed') {

            return Auth::user()->todos()->completed()->get();
        } elseif ($type === 'deleted') {

            return Auth::user()->todos()->onlyTrashed()->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Todo::class);
        // dd($request->all());

        return Auth::user()->todos()->create($this->validateTodo($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        if ($request->input('status') === 'true') {
            $todo->status = !$todo->status;
            $todo->save();
        } else {
            $todo->update(($this->validateTodo($request)));
        }

        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();
    }

    private function validateTodo(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:500',
            'status' => 'sometimes|required|boolean',
            'date_limit' => 'sometimes|required|date'
        ]);
    }
}