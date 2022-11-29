<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Http\Request;
use App\Models\Global\Slug;

class Category extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $city;
    public $category;
    //public $hui;


    public function __construct(Request $request)
    {
        $slug = Slug::where([
            ['slug', $request->category],
            ['essence_type', 'category']
            ])->first();
        $category = $slug->category($slug->essence_id, $request->city->id );
        $this->category = $category;
        $this->city = $request->city;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category');
    }
}
