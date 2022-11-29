<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;
use App\Models\Global\City;
use Illuminate\Http\Request;

class header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $city;
    public $cityList;
    public $catalog;

    public function __construct(Request $request)
    {
        $this->city = City::where('path', $request->route('city') ?? 'tomsk')->first();
        $this->cityList = City::get();

        $this->catalog = $this->getCategory();
    }

    function getCategory()
    {
        $category = Category::leftJoin('slug', function ($slug) {
            $slug->on('category.id', 'essence_id')
            ->where('essence_type', 'category');
        })
        ->select(
            'category.id as category_id',
            'category.name',
            'slug.slug',
        )
        ->get()->sort();
        return $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
