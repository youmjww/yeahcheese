<?php

/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    My
 */
class My_Action_CreateEvent extends My_ActionClass
{
    /**
     *  Login action implementation.
     *
     *  @access    public
     *  @return    string  Forward Name.
     */
    public function perform(): string
    {
        return 'createEvent';
    }
}
