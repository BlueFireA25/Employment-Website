<?php

namespace App\Http\Controllers;

use App\Models\Vacant;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $vacancies = Vacant::where('category_id', $category->id)->where('active', true)->paginate(10);

        return view('categories.show', compact('vacancies', 'category'));
    }
}
