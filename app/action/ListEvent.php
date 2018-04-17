<?php

class My_Action_ListEvent extends My_LoginActionClass
{
    public function perform(): string
    {
        $events = (new My_EventManager($this->backend))->getEventInfo($this->session->get('userInfo')[id]);
        $this->af->setApp('events', $events);
       return 'ListEvent';
    }
}
