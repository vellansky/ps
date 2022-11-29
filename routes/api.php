<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\Shop\ShopController;
use App\Http\Controllers\Api\Admin\Shop\NotificationController;


use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Admin\Orders\OrdersController;
use App\Http\Controllers\Api\User\PolicyController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\TelegramBotController;
use App\Http\Controllers\Api\PagesController;


use App\Http\Controllers\Api\Admin\Items\CategoriesController;
use App\Http\Controllers\Api\Admin\Items\ItemsController;

use App\Http\Controllers\Api\Admin\WarehouseController;

//Поисковая строка
Route::get('/search', [PagesController::class, 'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 * Загрузить товары со склада
 * Посмотреть товары в магазине
 * Изменить видимость товара
 * Изменить количество товара
 *
 * Изменить данные магазина
 * Изменить контакты магазина
 *
 * Настройки бота телелеграм
 * Создать подписчика телеграм
 * Удалить подписчика
 * Список подписчиков телеграм
 *
 */
//Route::post('/post/admin/product/fromwarehouse', [ProductController::class, 'fromWarehouse']);
Route::post('/post/admin/shop/create', [ShopController::class, 'shopCreate']);
Route::get('/get/admin/shop/list', [ShopController::class, 'shopList']);
Route::post('/post/admin/shop/item/add', [ShopController::class, 'itemAdd']);//up
Route::get('/get/admin/shop/item/list', [ShopController::class, 'getItemList']);
Route::post('/post/admin/shop/item/quantity', [ShopController::class, 'itemQuantity']);
Route::post('/post/admin/shop/item/visibility', [ShopController::class, 'itemVisibility']);
Route::post('/post/admin/shop/edit/data', [ShopController::class, 'editData']);
Route::post('/post/admin/shop/edit/contact', [ShopController::class, 'editContact']);
Route::post('/post/admin/shop/item/status', [ShopController::class, 'itemStatus']);

Route::post('/post/admin/shop/notification/telegram/bot/key', [NotificationController::class, 'botKey']);
Route::get('/post/admin/shop/notification/telegram/bot/status', [NotificationController::class, 'botStatus']);
Route::post('/post/admin/shop/notification/telegram/subscriber/add', [NotificationController::class, 'subscriberAdd']);
Route::post('/post/admin/shop/notification/telegram/subscriber/remove', [NotificationController::class, 'subscriberRemove']);
Route::post('/post/admin/shop/notification/telegram/subscriber/list', [NotificationController::class, 'subscriberList']);



/*
 * Список клиентов
 * Список заказов
 * Информация о заказе
 * Изменить статус заказа
 */
Route::get('/get/admin/order/client/list', [SliderController::class, 'clientList']);
Route::get('/get/admin/order/list', [SliderController::class, 'orderList']);
Route::get('/get/admin/order/id', [SliderController::class, 'orderId']);
Route::get('/get/admin/order/edit/status', [SliderController::class, 'orderEditStatus']);


//создать заказ
Route::post('/user/post/order/create', [OrdersController::class, 'addOrder']);
//принять политику сайта
Route::post('/user/policy/ok', [PolicyController::class, 'ok']);



/*
 * Список всех фотографий
 *
 */
Route::get('/get/admin/files/images/list', [SliderController::class, 'filesImagesList']);

/*
 *
 * Выбрать фотографию из списка
 */

/*
 *
 * Создать категорию
 * Изменить навзание категории
 * Список категории
 * Добавить товары в категорию
 */
Route::post('/post/admin/category/create', [SliderController::class, 'categoryCreate']);
Route::post('/post/admin/category/edit/name', [SliderController::class, 'categoryEditName']);
Route::post('/post/admin/category/items/add', [SliderController::class, 'categoryItemsAdd']);
Route::get('/get/admin/category/list', [SliderController::class, 'categoryList']);
/*
 * Количество магазинов
 * Количество товаров
 * Количество категорий
 * Количество заказов
 * Количество клиентов
 */
Route::get('/get/dashboard/shops', [SliderController::class, 'categoryList']);
Route::get('/get/dashboard/items', [SliderController::class, 'categoryList']);
Route::get('/get/dashboard/orders', [SliderController::class, 'categoryList']);
Route::get('/get/dashboard/clients', [SliderController::class, 'categoryList']);


/*
 * управление складом
 */
Route::post('/post/admin/warehouse/create', [WarehouseController::class, 'warehouseCreate']);
Route::post('/post/admin/warehouse/items/import', [WarehouseController::class, 'warehouseItemsImport']);
Route::get('/get/admin/warehouse/items/list', [WarehouseController::class, 'warehouseItemsList']);
Route::post('/post/admin/warehouse/items/edit', [WarehouseController::class, 'warehouseItemsEdit']);



/*
 * управление товарами
 */
Route::post('/post/admin/warehouse/items/import', [WarehouseController::class, 'warehouseItemsImport']);

/*
 * Управление категориями
 */
Route::post('/post/admin/categories/create', [CategoriesController::class, 'categoriesCreate']);
Route::get('/get/admin/categories/list', [CategoriesController::class, 'categorieslist']);
Route::post('/post/admin/categories/items/create', [CategoriesController::class, 'categoriesItemsCreate']);

/*
 * Управление товарами
 */
Route::get('/get/admin/items/list', [ItemsController::class, 'itemslist']);
Route::post('/post/admin/items/createList', [ItemsController::class, 'itemsCreateList']);
Route::post('/post/admin/items/update/info', [ItemsController::class, 'itemsUpdateInfo']);

/*
 * Управление заказами
 */
Route::get('/get/admin/order/detail', [OrdersController::class, 'detail']);
Route::get('/get/admin/order/list', [OrdersController::class, 'list']);
Route::get('/get/order/status', [OrdersController::class, 'listStatus']);
Route::post('/post/order/status/edit', [OrdersController::class, 'editStatus']);

/*
 * Дальше не делал
 */




/*
 *
 * Создать склад
 * Импортировать на склад продукты
 */


Route::get('/admin/slider', [SliderController::class, 'getSliders']);

Route::get('/admin/get/shops', [ShopController::class, 'getShops']);
Route::get('/admin/get/warehouses', [WarehouseController::class, 'getWarehouses']);
//Route::post('/admin/get/warehouses/items', [WarehouseController::class, 'getWarehouseItems']);


Route::get('/admin/products', [ProductController::class, 'getProducts']);
Route::post('/post/admin/products/id', [ProductController::class, 'getProductId']);
Route::post('/post/admin/edit/products/status', [ProductController::class, 'productEditStatus']);
Route::get('/admin/orders', [OrderController::class, 'getOrders']);
Route::get('/admin/category', [CategoryController::class, 'getCategory']);

Route::post('/admin/register', [RegisterController::class, 'create']);
Route::post('/admin/edit/product', [ProductController::class, 'editProduct']);
Route::post('/admin/edit/image', [ProductController::class, 'editImage']);
Route::post('/post/admin/product/import', [ProductController::class, 'importProducts']);
Route::post('/admin/create/category', [CategoryController::class, 'createCategory']);
Route::post('/admin/product/category', [CategoryController::class, 'selectCategory']);
Route::post('/admin/order/add', [OrderController::class, 'addOrder']);

Route::post('/cookie/set/city', [ProfileController::class, 'setCity']);


Route::post('/admin/edit/slider/img', [SliderController::class, 'sliderUploadImage']);
Route::post('/admin/edit/slider/inf', [SliderController::class, 'sliderEditInf']);
Route::post('/admin/slider/edit/status', [SliderController::class, 'sliderStatus']);



Route::get('/sendMessage', [TelegramBotController::class, 'sendMessage']);
