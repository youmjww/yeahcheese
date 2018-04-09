<?php

require_once dirname(__FILE__) . '/../app/My_Controller.php';

/**
 * If you want to enable the UrlHandler, comment in following line,
 * and then you have to modify $action_map on app/My_UrlHandler.php .
 *
 */
// $_SERVER['URL_HANDLER'] = 'index';

/**
 * Run application.
 */
My_Controller::main('My_Controller', 'index');

