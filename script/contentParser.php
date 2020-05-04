<?php

use app\models\NewsModel;
use core\Logger;
use PHPHtmlParser\Dom;

require_once dirname(__DIR__) . '/configs/init.php';

Logger::putLog('content_parser', 'start...');

$model = new NewsModel();
$parser= new Dom();

$link = $model->getLink()->link;
$id = $model->getLink()->id;

$page = $parser->load($link);
$article = $page->find('.article-text')->innerHTML;
$article = strip_tags($article);

$model->saveContent($id, $article);

Logger::putLog('content_parser', '...finish');