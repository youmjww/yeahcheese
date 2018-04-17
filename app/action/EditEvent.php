<?php
/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   My
 */

class My_Form_EditEvent extends My_ActionForm
{
    public $form = [
        'id'    => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'eventId',
            'required'   => true,
            'max'        => 12,
        ]
    ];
}

class My_Action_EditEvent extends My_LoginActionClass
{
    public function prepare()
    {
        $userId = $this->session->get('userInfo')[id];
        $eventId = $this->af->get('id');

        if ($this->af->validate() > 0 || ! is_numeric($eventId)) {
            return 'error404';
        }

        if (! (new My_EventManager($this->backend))->isEventOwnerCurrentUser($eventId, $userId)) {
            return 'error403';
        }
        return null;
    }

    public function perform()
    {
        return 'editEvent';
    }
}
