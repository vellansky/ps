<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\CategoryProducts;

class CategoryController extends Controller
{

    public function getCategory()
    {
        return Category::get();
    }

    public function createCategory(Request $req)
    {
        Category::updateOrCreate([
            'name' => $req->category,
        ],
        [
            'path' => Str::slug($req->category)

        ]);
        $categories = Category::get();
        return response($categories, 200);
    }

    public function selectCategory(Request $req){
        CategoryProducts::updateOrCreate([
            'products_id' => $req->product,
        ],
        [
            'category_id' => $req->category

        ]);
        return response(null, 200);
    }
}
