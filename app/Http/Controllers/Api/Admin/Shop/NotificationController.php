<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin\Notification\Telegram\Bot;
use App\Models\Admin\Notification\Telegram\Chat;
use App\Models\Admin\Notification\Telegram\Subscribes;

class NotificationController extends Controller
{
    public function botStatus(Request $r)
    {
        $bot = Bot::where('admin_id', 2)->select('id')->first();
        if(empty($bot)) {
            return response(false, 200);
        } else {
            return response(true, 200);
        }
    }

    public function botKey(Request $r)
    {
        Bot::updateOrCreate([
            'token' => $r['data']['token'],
        ],[
            'admin_id' => 1,
            'token' => $r['data']['token'],
        ]);
        $data = [
            'bot' => true,
            'text' => [
                "title" => 'Ваш бот подключен',
                "body" => 'Теперь добавьте подписчиков для этого бота'
            ]
        ];
        return response($data, 200);
    }

    public function subscriberAdd(Request $r)
    {
        $token = Hash::make($r->name . date("l"));
        Subscribes::where('admin_id', 1)->create([
            'name' => $r['data']['name'],
            'token' => $token,
            'admin_id' => 1,
            'shop_id' => $r->id,
        ]);
        $data = [
            'token' => $token,
            'text' => [
            "title" => 'Вы создали нового подписки',
            "body" => 'Передайте полученный токен сотруднику. Он должен отпраивть его в чат с вашим ботом'
            ]
        ];
        return response($data, 200);
    }

    public function subscriberRemove(Request $r)
    {
        $deleted = Subscribes::where('id', $r->id)->delete();
        return response(null, 200);
    }

    public function subscriberList(Request $r)
    {
        $list = Subscribes::where('shop_id', $r->id)->get();
        return response($list, 200);
    }
}
