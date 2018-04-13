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
            'type'       => [VAR_TYPE_FILE],
            'form_type'  => FORM_TYPE_FILE,
            'name'       => '写真',
            'custom'     => 'checkFileCapacity',
            'required'   => true,
        ],
    ];
    /**
     *  各写真の容量チェック
     *
     *  @access    public
     *  @param     string $photos フォームの項目名
     *  @return    string  Forward name (null if no errors.)
     */
    public function checkFileCapacity($photos)
    {
        foreach ($this->form_vars[$photos] as $photo) {
            if ($photo['size'] > 5000000) {
                $this->ae->add(null, '各画像サイズは5MB未満にしてください。', E_FORM_INVALIDVALUE);
            }
        }
    }
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

        $openDay = $this->af->get('openDay');
        $endDay = $this->af->get('endDay');
        if ($openDay > $endDay) {
            $this->ae->addObject(null, Ethna::raiseNotice('イベントの開始日は終了日より前にしてください', E_DATE));
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
