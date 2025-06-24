<?php
namespace App\Services;


use App\DTOs\Task\TaskData;
use App\DTOs\Task\TaskDTO;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function __construct(
        protected TaskRepositoryInterface $repository
    ) {}

    public function create(TaskData $data, int $userId): Task
    {
        $payload = [
            'title' => $data->title,
            'description' => $data->description,
            'is_completed' => $data->is_completed ?? false,
            'category_ids' => $data->category_ids,
            'user_id' => $userId,
        ];

        return $this->repository->store($payload);
    }

public function update(Task $task, TaskDTO $data): Task

{
$categoryIds = $data->category_ids ?? [];
$dataArray = [
    'title' => $data->title,
    'description' => $data->description,
    'is_completed' => $data->is_completed,
];
$task->update($dataArray);
$task->categories()->sync($categoryIds);
return $task->load('categories');

}


    public function delete(Task $task): void
    {
        $this->repository->delete($task);
    }
public function listTasks(User $user)
{
    return Task::with('categories')
        ->where('user_id', $user->id)
        ->get();
}
}
