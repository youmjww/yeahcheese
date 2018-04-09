<?php
/**
 *  {$action_name}.php
 *
 *  @author     {$author}
 *  @package    My
 */
chdir(dirname(__FILE__));
require_once '{$dir_app}/My_Controller.php';

ini_set('max_execution_time', 0);

My_Controller::main_CLI('My_Controller', '{$action_name}');
