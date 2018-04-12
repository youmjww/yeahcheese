<?php
/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    My
 */
class My_Action_home extends My_LoginActionClass
{
    /**
     *  Index action implementation.
     *
     *  @access    public
     *
     *  @return    string  Forward Name.
     */
    public function perform(): string
    {
        return 'home';
    }
}
