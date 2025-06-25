<?php

namespace App\DTOs\Task;

class TaskData
{
    public function __construct(
        public string $title,
        public ?string $description,
        public bool $is_completed,
        public array $category_ids
    ) {}
}
