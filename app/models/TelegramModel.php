<?php


namespace app\models;


class TelegramModel
{
    private $url;

    public function __construct()
    {
        $this->url = 'https://api.telegram.org/bot'.API_TOKEN.'/';
    }

    public function getChats(){
        $url = $this->url . 'getUpdates';
        $respons = json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
        $result = $respons['result'];
        $chats = [];
        foreach ($result as $item){
            $chats[] = $item['message']['chat'];
        }
        return $chats;
    }
    public function sendMessage($title, $article){

        $text = "<b>{$title}</b>\n\n{$article}";

        $url = $this->url . 'sendMessage';
        $chats = self::getChats();

        foreach ($chats as $chat){
            $chat_id = $chat['id'];
            $params = [
                'chat_id' => $chat_id,
                'text' => $text,
                'parse_mode' => 'HTML',
            ];

            $url = $url.'?'.http_build_query($params);
            return json_decode(file_get_contents($url));
        };
    }
}