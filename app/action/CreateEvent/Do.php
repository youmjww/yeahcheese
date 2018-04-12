<?php

/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    My
 */
class My_Action_CreateEventDo extends My_LoginActionClass
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
