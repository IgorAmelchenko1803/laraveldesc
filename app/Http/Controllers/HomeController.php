<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;

class HomeController extends Controller
{
    public function show()
    {
        $user = new User;
        $status = $user->getAuthUser();
        $subjects = Category::all();
        
        
        return view('dashboard', compact(['status', 'subjects']));
    }
}
