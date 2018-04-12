<?php

class My_Form_CreateEventDo extends My_ActionForm
{
    const MAX_EVENT_NAME_LENGTH = 30;
    /**
     *  @access   protected
     *
     *  @var      array   form definition.
     */
    public $form = [
        'eventName'    => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'イベント名',
            'max'        => self::MAX_EVENT_NAME_LENGTH,
            'required'   => true,
        ],
        'openDay'      => [
            'type'       => VAR_TYPE_DATETIME,
            'name'       => '公開開始日',
            'regexp'    =>  '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
            'required'   => true,
        ],
        'endDay'      => [
            'type'       => VAR_TYPE_DATETIME,
            'name'       => '公開終了日',
            'regexp'    =>  '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
            'required'   => true,
        ],
        'photos'      => [
            'type'       => VAR_TYPE_FILE,
            'name'       => '写真',
            'required'   => true,
        ],
    ];
}

/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    My
 */
class My_Action_CreateEventDo extends My_LoginActionClass
{
     /**
     *  preprocess regist user action.
     *
     *  @access    public
     *  @return    string  Forward name (null if no errors.)
     */
    public function prepare(): ?string
    {
        if ($this->af->validate() > 0) {
            return 'createEvent';
        }

        return null;
    }
    /**
     *  Login action implementation.
     *
     *  @access    public
     *  @return    string  Forward Name.
     */
    public function perform(): string
    {
        return 'createEvent';
    }
}
