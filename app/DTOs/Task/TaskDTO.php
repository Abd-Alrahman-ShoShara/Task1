<?php
namespace App\DTOs\Task;

class TaskDTO
{
    public function __construct(
    public readonly string $title,
    public readonly ?string $description,
    public readonly bool $is_completed,
    public readonly array $category_ids = [],
) {}

public static function fromRequest($request): self
{
    return new self(
        title: $request->title,
        description: $request->description,
        is_completed: $request->boolean('is_completed'),
        category_ids: $request->input('category_ids', [])
    );
}

}
