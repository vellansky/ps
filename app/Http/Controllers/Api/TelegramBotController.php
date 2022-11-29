<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\User\Telegram\AdminToken;
use App\Models\Subscribes\Subscribes;

class TelegramBotController extends Controller
{
    public function sendMessage()
    {

        /*

        setWebhook

        Получить чат ид (ид пользователя)q2e

        result->message->from->id

        Попросить вписать токен для телеграма который генерируется на сервере

        пользователь вписывает токен - я его получаю

        result->message->text

        проверяю, есть ли такой токен в базе

        если нет - отправляю сообщение в чат, что хуйня

        если есть - отправляю сообщение в чат, что теперь он будет получать заявкиŒ




        */
        //Получить токен телеграмма
        $admin = 1;

        $adminToken = AdminToken::where('admin_id', $admin)
        ->select('token')->first();
        //Получить магазин куда пришел заказ
        $shop = 1;

        $subscribes = Subscribes::where('shop_id', $shop)->select('id')->with('chat')->get();

        foreach($subscribes as $data)
            if($data->chat->isNotEmpty()){
                $data = [
                    'chat_id' => $data->chat->first()->chat_id,
                    'text' => 'Напиши Максу что ты получил сообщение'
                ];
                file_get_contents("https://api.settings.org/bot".$adminToken->token."/sendMessage?" .
                                            http_build_query($data) );
            } else {
                continue;
            }

        return response('ok', 200);

    }
}
