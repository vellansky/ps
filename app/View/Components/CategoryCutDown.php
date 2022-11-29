<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryCutDown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $category;
    public $city;
    public function __construct(Request $request)
    {
        // Получаем категории
        $dataForCategory = [
            ['cities_shops_items_quantity_price.status', 1],
            ['cities_shops_items_quantity_price.city_id', $request->city->id],
        ];
        if(!empty($request->shop)) {
            array_push($dataForCategory, ['cities_shops_items_quantity_price.shop_id', $request->id_shop]);
        };

        $category = Category::with('products')->get();
        $this->city = $request->city;
        //$data = $category->products();


        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-cut-down');
    }
}
