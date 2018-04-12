<?php
// vim: foldmethod=marker
/**
 *  My_ActionClass.php
 *
 *  @author     {$author}
 *  @package    My
 */

// {{{ My_ActionClass
/**
 *  action execution class
 *
 *  @author     {$author}
 *  @package    My
 *  @access     public
 */
class My_LoginActionClass extends My_ActionClass
{
    /**
     *  authenticate before executing action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    public function authenticate()
    {
        if (! $this->session->isStart()) {
            return 'login';
        }

        return parent::authenticate();
    }
}
// }}}

