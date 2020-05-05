<?php

use app\models\NewsModel;
use core\Logger;
use app\models\TelegramModel;
use PHPHtmlParser\Dom;

require_once dirname(__DIR__) . '/configs/init.php';
Logger::putLog('content_parser', 'start');

$model = new NewsModel();
$parser= new Dom();
$data = $model->getLink();

if ($link = $data->link){

    $id = $data->id;
    $title = $data->title;

    $pattern = [
        '/(-\sФОТО)/',
        '/(-\sВИДЕО)/'
    ];
    $replacement = '';
    $title = preg_replace($pattern, $replacement, $title );


    $page = $parser->load($link);
    $article = $page->find('.article-text')->innerHTML;
    $article = strip_tags($article);
    $model->saveContent($id, $article);

    Logger::putLog('content_parser', 'saved to database');

    $telegram  = new TelegramModel();

    $telegram->sendMessage($title, $article);

    Logger::putLog('content_parser', 'sent to telegram');
    Logger::putLog('content_parser', "success", true);
} else {
    Logger::putLog('content_parser', "error", true);
}
