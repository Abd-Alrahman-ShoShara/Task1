<?php

namespace App\Http\Controllers\Api;






use App\DTOs\Task\TaskData;

use App\DTOs\Task\TaskDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(private TaskService $service) {}

public function index()
{
    $tasks = Task::with('categories')->where('user_id', auth()->id())->get();
    return response()->json($tasks);
}



public function store(StoreTaskRequest $request)
{
    $data = new TaskData(
        title: $request->title,
        description: $request->description,
        is_completed: $request->is_completed ?? false,
        category_ids: $request->category_ids ?? [],
    );

    $task = $this->service->create($data, auth()->id());

    return response()->json(['message' => 'Task created', 'task' => $task]);
}


public function update(TaskUpdateRequest $request, Task $task): JsonResponse
{

$task = $this->service->update($task, TaskDTO::fromRequest($request));

    return response()->json($task);
}


    public function destroy(Task $task): JsonResponse
    {
        $this->service->delete($task);
        return response()->json(['message' => 'Task deleted']);
    }


    
}
