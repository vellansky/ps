<?php

namespace App\Http\Controllers\Api\Admin\Items;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\Global\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function categoriesCreate(Request $r)
    {
        $category = $r->toArray();

        if(empty($category)){
            return response(null,200);
        } else {
            foreach ($category as $value) {
                if ($value !== null && $value !== '' && $value !== ' ') {
                    $category = Category::updateOrCreate(
                        [
                            'name' => $value,
                        ]);
                        Slug::updateOrCreate(
                            [
                                'slug' => Str::slug($value, '-'),
                                'essence_id' => $category->id,
                                'essence_type' => 'category',

                            ]);
                } else {
                    continue;
                }
            }
        }
        return response(null,200);
    }

    public function categorieslist()
    {
        $category = Category::select('id', 'name')->get();
        return response($category, 200);
    }

    public  function categoriesItemsCreate(Request $r)
    {
        $categories = $r->toArray();
        foreach ($r['items'] as $product) {
            CategoryProducts::firstOrCreate([
                'category_id' => $r->caregoryId,
                'products_id' => $product
            ]);
        }

        return response(null, 200);
    }
}
