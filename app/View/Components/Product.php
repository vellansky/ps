<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Global\Slug;
use Illuminate\Http\Request;

class Product extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $product;
    public function __construct(Request $request)
    {
        $slug = Slug::where([
            ['slug', $request->product],
            ['essence_type', 'product']
            ])->first();
        $category = $slug->product($slug->essence_id, $request->city->id );

        $this->product = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product');
    }
}
