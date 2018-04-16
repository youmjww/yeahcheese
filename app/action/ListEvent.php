<?php

class My_Form_ListEvent extends My_ActionForm
{
    /**
     *  @access   protected
     *
     *  @var      array   form definition.
     */
    public $form = [
    ];
}

class My_Action_ListEvent extends My_LoginActionClass
{
    public function prepare(): ?string
    {
        if ($this->af->validate() > 0) {
            return 'ListEvent';
        }

        return null;
    }

    public function perform(): string
    {
       return 'ListEvent';
    }
}
