<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Category;
use App\Models\Sybcategory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'text', 'user_id', 'category_id', 'subcategory_id'];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function subcategory()
{
    return $this->belongsTo(Subcategory::class);
}

    public static function insertMessage($id, $name, $text, $catId, $subcatId)
    {
        self::create([
            'user_id' => $id,
            'name' => $name,
            'text' => $text,
            'category_id' => $catId,
            'subcategory_id' => $subcatId,
        ]);
    }

}
