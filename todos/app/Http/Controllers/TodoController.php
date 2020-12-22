<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use SebastianBergmann\Environment\Console;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'td_content' => 'required|max:510|min:1'
        ]);

        return Todo::create($data);

        /*
        try {
            $this->validate($request, [
                'td_content' => 'required|max:5|min:1'
            ]);

            $todo = Todo::create(['td_content' => $request->td_content]);

            return response()->json([
                'status' => 'ok',
                'todo' => $todo
            ], 201)
        } catch (ValidationException $exception) {
            return response()->json([
                'status' => 'ok',
                'todo' => $todo
            ], 422)
        }*/
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
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
    public function update(Request $request, $id)
    {
        if (isset($request->td_content)) {
            $data = $request->validate([
                'td_content' => 'required|max:510|min:1'
            ]);

            Todo::where('id', $id)->update($data);
        } else {
            $todo = Todo::where('id', $id)->first();

            $todo->td_status = !$todo->td_status;

            $todo->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
    }
}