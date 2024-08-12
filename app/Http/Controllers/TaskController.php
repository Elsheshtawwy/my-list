<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{


    public function store(Request $request)
{
    $inputs = $request->validate([
        'name' => ['string', 'required'],
        'description' => ['max:1000'],
        'is_done' => ['boolean'],
        'before_date' => [],
        'priority' => ['required', 'string', 'in:low,mid,high']
    ]);

    Task::create($inputs);

    return response()->json([
        'data' => 'task created successfully'
    ]);
}



public function show($id){
    // Find the task by id
    $task = Task::find($id);
    return response()->json([
        'data' => $task
    ]);
}

    public function index(Request $request)
    {
        $request->validate([
            'sort' => ['in:before_date,priority,id']
        ]);
        $tasks = Task::query();

        if ($request->has('priority')) {
            $tasks = $tasks->where('priority', '=', $request->input('priority'));
        }
        if ($request->has('upcoming')) {
            $tasks = $tasks->where('before_date', '>=', date('Y-m-d H-i'));
        }
        if ($request->has('is_done')) {
            $tasks = $tasks->where('is_done', '=', $request->input('is_done'));
        }
        if ($request->has('sort')) {
            $tasks = $tasks->orderBy($request->input('sort'), 'asc');
        }

        return response()->json([
            'data' => $tasks->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->validate([
            "name" => ["string"],
            "description" => ["string", "max:1000"],
            "is_done" => ["boolean"],
            "before_date" => [],
            "priority" => ["string", "in:low,mid,high"]
        ]);
        $task = Task::findOrFail($id);
        $task->update($input);
        return response()->json([
            "message" => "Task updated successfully ;)",
            "task" => $task
        ]);
    }
    

public function destroy($id) {
    // Find the user by id
    $task = Task::findOrFail($id);
    // Delete the user
    $task->delete();
    // Return success message
    return response()->json([
        "message" => "Task deleted successfully ;)"
    ]);
}

}