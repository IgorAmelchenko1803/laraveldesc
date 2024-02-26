<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Message;

class SubcategoryController extends Controller
{
    public function show($categoryId, $subcategoryId)
    {
        $category = Category::find($categoryId)->name;
        $subcategory = Subcategory::find($subcategoryId)->name;
        $messages = Message::where('category_id', $categoryId)
        ->where('subcategory_id', $subcategoryId)
        ->orderBy('created_at', 'desc') // Сортировка по полю created_at в порядке убывания
        ->paginate(10); // Пагинация по 10 записей на страницу
        
        return view('subcategory', compact(['subcategory' , 'category', 'messages']));
    }

   
}
