<?php
/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   My
 */

class My_Form_UpdateEvent extends My_ActionForm
{
    public $form = [
        'openDay'    => [
            'type'       => VAR_TYPE_STRING,
            'name'       => '公開開始日',
            'requir' => true
        ],

        'endDay' => [
            'type' => VAR_TYPE_STRING,
            'name' => '公開終了日',
            'requir' => true
        ],

        'eventName' => [
            'type' => VAR_TYPE_STRING,
            'name' => 'イベント名',
            'requir' => true
        ],

        'eventId' => [
            'type' => VAR_TYPE_STRING,
            'name' => 'eventId',
            'requir' => true
        ],
    ];
}

class My_Action_UpdateEvent extends My_LoginActionClass
{
    public function perform()
    {
        $eventId = $this->af->get('eventId');
        $eventName = $this->af->get('eventName');
        $openDay = $this->af->get('openDay');
        $endDay = $this->af->get('endDay');

        (new My_EditManager($this->backend))->updateEvent($openDay, $endDay, $eventId, $eventName);
        header("Location: ?action_editEvent=true&id=$eventId");

        return null;
    }
}
