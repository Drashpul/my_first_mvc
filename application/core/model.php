<?php

class Model
{

    private $db_connection;

    /**
     * @var string #Название таблицы модели
     */
    public $table_name;

    /**
     * @var string #Тип запроса
     */
    private $query_type = 'SELECT';

    /**
     * @var $condition #Условие выборки
     */
    private $condition;


    private $field_list = '*';

    private $query_array = [];

    private $query_string;

    private $query_limit;

    private $query_order;

    public function __construct()
    {
        $this->db_connection = DBConnect::connect();
    }

    public function getConnection()
    {
        return $this->db_connection;
    }


    public function where($field, $param, $operator = 'AND')
    {
        $condition = $this->condition ? " $operator" : "WHERE";
        if (is_array($param)) {
            $this->condition .= "$condition $field IN (";
            $params = implode(array_map(function ($item) {
                return is_string($item) ?
                    $this->db_connection->quote($item) : $item;
            }, $param), ', ');
            $this->condition .= $params;
            $this->condition .= ')';
        } else {
            $this->condition .= "$condition $field = '$param'";
        }
        return $this;
    }

    public function toSql()
    {
        return $this->getQueryString();
    }

    public function find($id)
    {
        $this->where('id', $id);
        $prepare = $this->db_connection->prepare($this->getQueryString());
        $object = $prepare->execute();
        return $object;
    }

    public function get()
    {
        $this->collection = [];
        $result = $this->db_connection->query($this->getQueryString());
        if($result) {
            foreach ($result as $item) {
                $this->collection[] = $item;
            }
        }
        return $this->collection;
    }

    public function getQueryString()
    {
        $this->query_string = implode([
            'query_type' => $this->query_type,
            'field_list' => $this->field_list,
            'from_table' =>
                ($this->query_type == 'SELECT') ? 'FROM' : NULL,
            'table_name' => $this->table_name,
            'condition' => $this->condition,
            'query_order' => $this->query_order,
            'query_limit' => $this->query_limit,
        ], ' ');
        return $this->query_string;
    }

    public function delete($id)
    {
        $this->query_type = 'DELETE';
        $this->feld_list = NULL;
    }

    /*
        Модель обычно включает методы выборки данных, это могут быть:
            > методы нативных библиотек pgsql или mysql;
            > методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
            > методы ORM;
            > методы для работы с NoSQL;
            > и др.
    */
    // метод выборки данных
    public function get_data()
    {
        // todo
    }
}

//========OLD MODEL============================
//
//class Model
//{
//    private $db_connection;
//    /**
//     * @var string #Название таблицы модели
//     */
//    public $table_name;
//    private $query_type;
//    private $condition;
//    private $field_list = '*';
//    private $query_array = [];
//    private $query_string;
//    private $query_limit;
//    private $query_order;
//
//    public function __construct()
//    {
//        $this->db_connection = DBConnect::connect();
//    }
//    public function getConnection()
//    {
//        return $this->db_connection;
//    }
//
//
//    //----------ЭТО добавлено на уроке 20 со скайпа----------
//
//
//    public function where($field, $param, $operator = 'AND'){
//        $condition =    $this->condition ? "  $operator" : "WHERE";
//
//
//        if(is_array($param)){
//            $this->condition .= "$condition $field IN (";
//            $params = implode(array_map(function($item){
//                return is_string($item) ?
//                    $this->db_connection->quote($item) : $item;
//            }, $param), ', ');
////            var_dump($params);
//            var_dump($this->condition);
//            die;
//
//            $this->condition .= $params;
//            $this->condition .= ')';
//        }else{
//            $this->condition = "$condition $field = '$param'";
//        }
//        return $this;
//    }
//
//    public function toSql(){
//        return $this->getQueryString();
//    }
//    public function get(){
//        $object = $this->db_connection->query($this->getQueryString());
//        return $object;
//    }
//
//    public function getQueryString(){
//        $this->query_string = implode([
//            'query_type' => $this->query_type,
//            'field_list' => $this->field_list,
//            'from_table' =>
//                ($this->query_type == 'SELECT') ? 'FROM' : NULL,
//            'table_name' => $this->table_name,
//            'condition' => $this->condition,
//            'query_order' => $this->query_order,
//            'query_limit' => $this->query_limit,
//        ], ' ');
//        return $this->query_string;
//    }
//
//
////=========================================================
//
//
////
////    public function get(){
////        $this->query_type = 'SELECT';
////    }
////    private function buildQuery(){
////        return $this->query = $this->getQueryType();
////    }
////    private function getQueryType(){
////        return "$this->query_type ";
////    }
////    private function getQueryCondition(){
////        if($this->condition){
////            return "WHERE $this->condition";
////        }
////    }
//    /*
//        Модель обычно включает методы выборки данных, это могут быть:
//            > методы нативных библиотек pgsql или mysql;
//            > методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
//            > методы ORM;
//            > методы для работы с NoSQL;
//            > и др.
//    */
//    // метод выборки данных
//    public function get_data()
//    {
//        // todo
//    }
//}