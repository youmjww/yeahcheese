<?php
class My_Action_AuthEvent extends My_LoginActionClass
{
    public function perform(): string
    {
        return 'authEvent';
    }
}
