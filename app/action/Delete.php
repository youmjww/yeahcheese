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
        'photos' => [
            'type'  => [VAR_TYPE_STRING],
            'name'  => 'photoIds',
        ],

        'eventId' => [
            'type'     => VAR_TYPE_STRING,
            'name'     => 'eventId',
            'required' => true
        ],
    ];
}

class My_Action_Delete extends My_LoginActionClass
{
    public function prepare()
    {
        $userId = $this->session->get('userInfo')[id];
        $eventId = $this->af->get('eventId');

        if ($this->af->get('photos') === null) {
            $this->ae->add(null, '削除する写真が選択されていません');
            return 'error';
        }

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
        $eventId = $this->af->get('eventId');
        (new My_EditManager($this->backend))->deletePhotos($this->af->get('photos'));
        header("Location: ?action_editEvent=true&id=$eventId");

        return null;
    }
}
