<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'is_completed', 'user_id'];



// app/Models/Task.php

public function categories()
{
    return $this->belongsToMany(Category::class, 'category_task');
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
