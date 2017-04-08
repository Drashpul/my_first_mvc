<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.04.17
 * Time: 11:38
 */
class ControllerMain extends Controller{
    function index(){
//        var_dump('action_name');
        $this->view->generate('main_view.php', 'template_view.php');
            }
}
