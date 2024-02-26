<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Message;

class AdminController extends Controller
{
    //Оторбажение страниц
    public function main()
    {
        
       return view('admin.main');
    }

    public function showCreateCategory()
    {
        $subjects = Category::all();
        return view('Admin.showCreateCategory', compact('subjects'));
    }

    public function showEditCategory()
    {
        $subjects = Category::all();
        return view('admin.showEditCategory', compact('subjects'));
    }

    public function showDeleteCategory()
    {
        $subjects = Category::all();
        return view('admin.showDeleteCategory', compact('subjects'));
    }

    public function destroyCategory(Request $request)
    {
        $subId = $request->input('subId');
        
            //  Удаление записей сообщений (messages) с указанным category_id
        Message::where('category_id', $subId)->delete();

    
        //  Удаление записей из таблицы связей category_subcategory с помощью фасада DB
        DB::table('category_subcategory')->where('category_id', $subId)->delete();

        //  Удаление категории (category) по id
        $category = Category::findOrFail($subId); // Если категории нет, будет выброшено исключение ModelNotFoundException
        $category->delete();
        
        // После выполнения удаления вы можете добавить редирект с сообщением об успешном удалении
        return redirect()->back()->with('success', 'Категория и связанные с ней данные успешно удалены.');
    }

    public function showCreateSubcategory()
    {
        $subSubjects = Subcategory::all();
        return view('admin.showCreateSubcategory', compact('subSubjects'));
    }

    public function showEditSubcategory()
    {
        $subSubjects = Subcategory::all();
        return view('admin.showEditSubcategory', compact('subSubjects'));
    }

    public function showDeleteSubcategory()
    {
        dd('showDeleteSubcategory');
    }

    public function showInsertSubcategory()
    {
        $categories = Category::all();
        $subcategories =  Subcategory::all();
        return view('admin.showInsertSubcategory', compact(['categories', 'subcategories']));
    }

    public function showCreateMessage()
    {
        dd('showCreateMessage');
    }

    public function showEditMessage()
    {
        dd('showEditMessage');
    }

    public function showDeleteMessage()
    {
        dd('showDeleteMessage');
    }


    //Действия  с категориями
    public function storeCategory(Request $request)
    {
        $requestData = $request->all();
        // Обрезка пробелов в начале и конце строки для поля 'name'
        $requestData['name'] = trim($requestData['name']);

        $validator = Validator::make($requestData, [
            'name' => 'required|string|min:4|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// Если не прошла валидация
        }
        $name = trim($request->input('name'));
        
        $existingCategory = Category::where('name', $name)->first();

        if ($existingCategory) {
            // Если категория с таким именем уже существует, возвращаем пользователя
            // назад с flash-сообщением о существовании такой категории
            Session::flash('error', 'Категория с таким именем уже существует.');
            return redirect()->back()->withInput();
        } else {
            // Если категории с таким именем нет, создаем новую категорию
            $newCategory = new Category();
            $newCategory->name = $name;
            $newCategory->save();

            // Фиксируем успех создания новой категории в flash-сообщении
            Session::flash('success', 'Новая категория успешно создана.');
            return redirect()->route('admin.create.category'); 
    }

    }

    public function storeEditCategory(Request $request)
    {
        $newName = $request->input('name');
        $oldNameId = $request->input('subId');
        
        $category = Category::findOrFail($oldNameId);
        $category->name = $newName;
        $category->save();

         return redirect()->route('admin.edit.category')->with('success', 'Категория успешно обновлена.');
    }

    //Действия с подкатегориями

    public function storeCreateSubcategory(Request $request)
    {
        $requestData = $request->all();
        // Обрезка пробелов в начале и конце строки для поля 'name'
        $requestData['name'] = trim($requestData['name']);

        $validator = Validator::make($requestData, [
            'name' => 'required|string|min:4|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();// Если не прошла валидация
        }
        $name = trim($request->input('name'));
        
        $existingSubCategory = Subcategory::where('name', $name)->first();

        if ($existingSubCategory) {
            // Если категория с таким именем уже существует, возвращаем пользователя
            // назад с flash-сообщением о существовании такой категории
            Session::flash('error', 'Подкатегория с таким именем уже существует.');
            return redirect()->back()->withInput();
        } else {
            // Если категории с таким именем нет, создаем новую категорию
            $newSubategory = new Subcategory();
            $newSubategory->name = $name;
            $newSubategory->save();

            // Фиксируем успех создания новой категории в flash-сообщении
            Session::flash('success', 'Новая подкатегория успешно создана.');
            return redirect()->route('admin.create.subcategory'); 
    }
}

public function storeEditSubcategory(Request $request)
{
    $newName = $request->input('name');
    $oldNameId = $request->input('subId');
    
    $category = Subcategory::findOrFail($oldNameId);
    $category->name = $newName;
    $category->save();

    return redirect()->route('admin.edit.subcategory')->with('success', 'Подкатегория успешно обновлена.');
}

public function storeInsertSubcategory(Request $request)
{
    $categoryId =  $request->input('categoryId');
    $subcategoryId =  $request->input('subcategoryId');
    if($categoryId === 'all'){
        $categories = Category::all();
        foreach($categories as $category){
            $existingLink = DB::table('category_subcategory')
            ->where('category_id', $category->id)
            ->where('subcategory_id', $subcategoryId)
            ->first();

            if ($existingLink) {
                continue;
            }
            else{
                DB::table('category_subcategory')->insert([
                    'category_id' => $category->id,
                    'subcategory_id' => $subcategoryId,
                ]);
            }
           
        }
        return redirect()->back()->with('success', 'Сабкатегория успешно добавлена во все категории');

    }
    $existingLink = DB::table('category_subcategory')
    ->where('category_id', $categoryId)
    ->where('subcategory_id', $subcategoryId)
    ->first();

    if ($existingLink) {
        // Если связь существует, возвращаем пользователя обратно с сообщением
        return redirect()->back()->with('success', 'Эта подкатегория уже присвоена категории.');
    }

// В противном случае вставляем новую запись в таблицу связей
DB::table('category_subcategory')->insert([
    'category_id' => $categoryId,
    'subcategory_id' => $subcategoryId,
]);
    return redirect()->back()->with('success', 'Сабкатегория успешно добавлена в категорию');
}

}
