<?php

namespace App\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function store(array $data): Task;
    public function update(Task $task, array $data): Task;
    public function delete(Task $task): void;
    public function getByUser(int $userId): array;
}
