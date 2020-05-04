<?php


namespace core;


class Logger
{
    static public function putLog($name, $string, $end = false){

        $path = dirname(__DIR__) . '/logs/' . $name . '.txt';
        $end = $end ? "\n" : NULL;
        $date = date('Y-m-d H:i:s', time());
        $space = strlen($string.$date) < 60 ? str_repeat('.', 60 - strlen($string . $date))."\t" : "\t";
        $text = $string .$space.$date. "\n" . $end;

        file_put_contents($path, $text, FILE_APPEND);
    }
}