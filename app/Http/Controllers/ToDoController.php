<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function index() {
        $todos = Todo::all();
        
        return view('to_dos.index', compact('todos'));
    }

    public function create() {
        return view('to_dos.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,completed',
        ]);

        Todo::create($request->all());
        return redirect()->route('to-dos.index')->with('success', 'Todo created successfully');
    }

    public function edit(Todo $to_do) {
        return view('to_dos.edit', compact('to_do'));
    }

    public function update(Request $request, Todo $to_do) {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,completed',
        ]);

        $to_do->update($request->all());
        return redirect()->route('to-dos.index')->with('success', 'Todo updated successfully');
    }

    public function destroy(Todo $to_do) {
        $to_do->delete();
        return redirect()->route('to-dos.index')->with('success', 'Todo deleted successfully');
    }
}
