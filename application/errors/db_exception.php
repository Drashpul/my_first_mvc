<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.04.17
 * Time: 21:01
 */
class DBException extends Exception{
    public function action(){
        echo $this->getMessage();
        die;
    }
}
