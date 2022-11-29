<?php

namespace App\View\Components;

use App\Models\Admin\Shop\Shop;
use Illuminate\View\Component;

class Cart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $shopList;
    public function __construct()
    {
        $this->shopList = Shop::get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart');
    }
}
