<?php

namespace App\View\Components;

use App\Models\Global\City;
use App\Models\Global\Items;
use App\Models\Product\Product;
use App\Models\Products;
use Illuminate\View\Component;
use Illuminate\Http\Request;

class ProductShowcase extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $city;
     public $products;
    public function __construct(Request $request)
    {


        // Получаем товары
        $dataForProducts = [
            ['cities_shops_items_quantity_price.status', 1],
            ['cities_shops_items_quantity_price.city_id', $request->city->id],

        ];
        if(!empty($request->id_shop)) {
            array_push($dataForProducts, ['cities_shops_items_quantity_price.shop_id', $request->id_shop]);
        };
        $products = Items::where($dataForProducts)
            ->join('products', 'cities_shops_items_quantity_price.product_id', 'products.id')
            ->leftJoin('slug', 'products.id', 'slug.essence_id')
            ->leftJoin('category_product', 'products.id', 'category_product.products_id')
            ->leftJoin('category', 'category_product.category_id', 'category.id')
            ->join('product_price', function ($price) {
                $price->on('cities_shops_items_quantity_price.product_id', 'product_price.product_id')
                ->latest();
            })
            ->join('images', function ($image) {
                $image->on('products.id', 'images.imageable_id')
                ->where('imageable_type', 'product');
            })

            ->select(
                'cities_shops_items_quantity_price.id',
                'cities_shops_items_quantity_price.city_id',
                'cities_shops_items_quantity_price.shop_id',
                'cities_shops_items_quantity_price.product_id',

                'products.name',

                'images.name as image_name',
                'images.url as image_url',

                'slug.slug as slug_path',

                'category.id as category_id',

                'product_price.id as price_id',
                'product_price.price',
                'product_price.new_price',

                'category_product.id as category_id'

            )
            ->get()->unique('product_id');


        $this->city = $request->city;
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-showcase');
    }
}
