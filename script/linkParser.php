<?php


use app\models\NewsModel;
use core\Logger;
use PHPHtmlParser\Dom;

require_once dirname(__DIR__) . '/configs/init.php';

Logger::putLog('link_parser', 'start');

$model = new NewsModel();
$parser= new Dom();

$page = $parser->load('https://www.061.ua/news');
$news = $page->find('.c-news-card__title');
$index = 0;
foreach ($news as $new) {
    Logger::putLog('link_parser', 'save - '.$index);
    $title = strip_tags($new->innerHTML);
    $link = $new->getAttribute('href');
    $model->saveLinks($title, $link);
    $index++;
}

Logger::putLog('link_parser', "finish", true);
