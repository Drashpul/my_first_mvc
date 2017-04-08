<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.04.17
 * Time: 19:18
 */

class DBConnect
{
    private static $connect;
    protected $db_user;
    protected $db_password;
    protected $db_host;
    protected $db_port;
    protected $db_name;
    private function __construct()
    {
        $config = (include_once realpath(__DIR__ . '/../../config/database.php'));
        $this->db_user = $config['db_username'];
        $this->db_password = $config['db_user_password'];
        $this->db_name = $config['db_name'];
        $this->db_host = $config['db_host'];
        $this->db_port = $config['db_port'];
    }
//    public function getConnect()
//    {
//        $app_connect = new PDO(
//            "mysql:dbname=$this->db_name;host=$this->db_host",
//            $this->db_user, $this->db_password);
//
//        return $app_connect;
//    }

//

    public function getConnect()
    {
        try{
            $app_connect = new PDO(
                "mysql:dbname=$this->db_name;host=$this->db_host; charset=utf8",
                $this->db_user, $this->db_password);

            return $app_connect;
        } catch (PDOException $e){
            echo $e->getMessage();
        }

    }


    static public function connect()
    {
        if (empty(self::$connect)) {
            $connect = new self;
            self::$connect = $connect->getConnect();
        }
        return self::$connect;

    }


//    static public function connect()
//    {
//        if (!empty(self::$connect)) {
//            return self::$connect;
//        } else {
//            $connect_object = new self;
//            return self::$connect = $connect_object->getConnect();
//        }


//        $connect = mysqli_connect('localhost', $config['user'], $config['password']);
//
//        if(!$connect){
//            die('Ошибка подключения: '. mysqli_connect_error($connect));
//        }
//
//
//        return mysqli_select_db($connect, 'feed');
//    }
}