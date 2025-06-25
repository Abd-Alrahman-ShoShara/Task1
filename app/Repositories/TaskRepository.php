<?php
namespace App\Repositories;


use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
     public function store(array $data): Task
    {
        // فصل category_ids عن باقي البيانات
        $categoryIds = $data['category_ids'] ?? [];
        unset($data['category_ids']);

        // إنشاء الـ Task
        $task = Task::create($data);

        // ربط التصنيفات (categories)
        $task->categories()->sync($categoryIds);

        return $task;
    }
    public function create(array $data): Task
{
    $categories = $data['category_ids'] ?? [];
    unset($data['category_ids']);

    $task = Task::create($data);
    $task->categories()->sync($categories);

    return $task;
}

   public function update(Task $task, array $data): Task
    {
        $categoryIds = $data['category_ids'] ?? null;
        unset($data['category_ids']);

        $task->update($data);

        if ($categoryIds !== null) {
            $task->categories()->sync($categoryIds);
        }

        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    public function getByUser(int $userId): array
    {
        return Task::with('categories')->where('user_id', $userId)->get()->toArray();
    }
}
