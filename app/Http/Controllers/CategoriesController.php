<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //و
        public function allCategories()
    {
        $allCategories = Category::all();
        return response()->json(['Categories' => $allCategories]);
    }
}
