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
     *  preprocess regist user action.
     *
     *  @access    public
     *
     *  @return    string  Forward name (null if no errors.)
     */
    public function prepare(): ?string
    {
        if (!$this->session->isStart()) {
            return 'login';
        }
        return null;
    }

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
