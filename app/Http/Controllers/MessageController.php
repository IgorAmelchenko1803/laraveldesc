<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; 

class MessageController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('createMessage', compact(['categories', 'subcategories']));
    }

    public function store(Request $request)
    {
        
        $id = $request->user()->id; 
        $name = $request->input('name');
        $text = $request->input('text');
        $catId = $request->input('categoryId');
        $subcatId = $request->input('subcategoryId');
    
        // Вставляем сообщение в базу данных
        Message::insertMessage($id, $name, $text, $catId, $subcatId);
    
        // Редиректим на нужную страницу с сообщением об успехе.
        return redirect()->route('create.message')->with('success', 'Сообщение добавлено.');
    }

    public function showMessage($id)
    {
        $message = Message::find($id);
        
        return view('showMessage', compact('message'));
    }

    public function showUserMessages()
    {
       $id = Auth::id();
       $messages = Message::where('user_id', $id)
       ->orderBy('created_at', 'desc') // Сортировка по полю created_at в порядке убывания
       ->paginate(10); // Пагинация по 10 записей на страницу
       return view('editMessages', compact('messages'));
    }

    public function destroy(Request $request)
    {
        $id = $request->input('delete');
        $msg = Message::findOrFail($id);
        $msg->delete();

        return redirect()->route('show.messages')->with('success', 'Сообщение удалено');
    }

    public function editMessage($id)
    {
       $categories = Category::all();
       $subcategories = Subcategory::all();
       $message = Message::find($id);
       $categoryId = $message->category_id;
       $subcategoryId = $message->subcategory->id;
       return view('editMessage', compact('categories', 'subcategories', 'message', 'categoryId', 'subcategoryId'));
       
    }
    public function saveEditedMessage(Request $request, $id)
    {
        // Находим сообщение по id
        $message = Message::find($id);
        if (!$message) {
            return redirect()->back()->with('error', 'Сообщение не найдено');
        }
    
        // Проверяем права пользователя через Gate
        if (Gate::allows('delete-admin-message') or Gate::allows('show-my-message', $message)) {
            $message->name = $request->input('name');
            $message->text = $request->input('text'); // Добавлены пропущенные кавычки вокруг 'text'
            $message->category_id = $request->input('categoryId');
            $message->subcategory_id = $request->input('subcategoryId');
            $message->save();
    
            // Редиректим обратно с сообщением об успехе
            return redirect()->back()->with('success', 'Сообщение изменено');
        } else {
            // Если у пользователя нет доступа, редиректим обратно с сообщением об ошибке
            return redirect()->back()->with('error', 'У вас нет прав для выполнения этого действия');
        }
    }


}
