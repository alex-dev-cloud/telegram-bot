<?php


namespace app\models;


use core\DB;

class NewsModel
{
    public function saveLinks($title, $link){

        $query = "INSERT INTO news_links (title, date, link) VALUES (:title,:date,:link)";
        $statement = DB::prepare($query);
        $data = [
            'title' => $title,
            'date' => date('Y-m-d H-i-s', time()),
            'link' => $link,
        ];
        return $statement->execute($data);
    }

    public function getLink(){

        $query = "SELECT id,link FROM news_links WHERE is_used = '0'";
        $result = DB::query($query);
        return $result->fetch(\PDO::FETCH_OBJ);
    }

    public function setUsed($id){

        $query = "UPDATE news_links SET is_used = '1' WHERE id = :id";
        $statement = DB::prepare($query);
        $data = [
            'id' => $id,
        ];
        return $statement->execute($data);
    }

    public function saveContent($id, $content){
        $query = "INSERT INTO news_content (article, news_link_id) VALUES (:article,:news_link_id)";
        $statement = DB::prepare($query);
        $data = [
            'article' => $content,
            'news_link_id' => $id,
        ];
        self::setUsed($id);
        return $statement->execute($data);
    }

}