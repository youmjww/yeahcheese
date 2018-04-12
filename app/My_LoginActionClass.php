<?php
/**
 *  My_LoginActionClass.php
 *
 *  @author     {$author}
 *  @package    My
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
    public function authenticate(): ?string
    {
        if (! $this->session->isStart()) {
            return 'login';
        }

        return parent::authenticate();
    }
}
