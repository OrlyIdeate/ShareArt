<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\ToDolist;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todoes = ToDolist::getAllOrderByUpdated_at();
        return response()->view('todo.index', compact('todoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required | max:191',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('todo.create')
                ->withInput()
                ->withErrors($validator);
        }

        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $result = ToDolist::create($data);

        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
