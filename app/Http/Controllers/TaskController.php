<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tasks = Task::query()
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    private function data(Task $task) {
        return [
            'task' => $task
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tasks.create', $this->data(new Task()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'deadline' => ['required', 'date'],
            'priority' => ['nullable', 'numeric'],
            'input_status' => ['required', 'string', 'max:255']
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'status' => $request->input_status
        ]);

        return redirect()->to('admin-panel/dashboard/tasks')
                ->with('success', 'Create Successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) {
        return view('tasks.show', $this->data($task));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task) {
        return view('tasks.edit', $this->data($task));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task) {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'deadline' => ['required', 'date'],
            'priority' => ['nullable', 'numeric'],
            'input_status' => ['required', 'string', 'max:255']
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'status' => $request->input_status
        ]);

        return redirect()->to('admin-panel/dashboard/tasks')
                ->with('success', 'Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task) {
        $task->delete();

        return redirect()->to('admin-panel/dashboard/tasks')
                ->with('success', 'Deleted Successfully!!!');
    }

    public function mark_as_completed(Task $task) {
        $task->update([
            'status' => "complete"
        ]);

        return redirect()->to('admin-panel/dashboard/tasks')
                ->with('success', 'Updated Successfully!!!');
    }

    public function all_delete() {
        Task::truncate();

        return redirect()->to('admin-panel/dashboard/tasks')
                ->with('success', 'Deleted Successfully!!!');
    }
}
