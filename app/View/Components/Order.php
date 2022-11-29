<?php

namespace App\View\Components;

use App\Models\Global\Slug;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Order extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $order;
    public $urlOrder;
    public function __construct(Request $requset)
    {
        $essence = Slug::where([
            ['slug', $requset->slug],
            ['essence_type', 'order']
        ])->first();
        $order = $essence->order($essence->essence_id);
        $this->urlOrder = $essence->slug;
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order');
    }
}
