<?php

class My_Action_ListEvent extends My_LoginActionClass
{
    public function perform(): string
    {
        (new My_EventManager($this->backend))->getEventInfo($this->session->get('userInfo')[id]);
       return 'ListEvent';
    }
}
