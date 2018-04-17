<?php
/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   My
 */

class My_Form_Delete extends My_ActionForm
{
    public $form = [
        'photos'    => [
            'type'       => [VAR_TYPE_STRING],
            'name'       => 'photoIds',
        ],

        'eventId' => [
            'type' => VAR_TYPE_STRING,
            'name' => 'eventId',
            'requir' => true
        ],
    ];
}

class My_Action_Delete extends My_LoginActionClass
{
    public function perform()
    {
        $eventId = $this->af->get('eventId');
        (new My_EditManager($this->backend))->deletePhotos($this->af->get('photos'));
        header("Location: ?action_editEvent=true&id=$eventId");

        return null;
    }
}
