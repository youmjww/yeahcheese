<?php
/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   My
 */

class My_Form_AuthEventDo extends My_ActionForm
{
    const MAX_AUTH_KEY_LENGTH = 9;
    public $form = [
        'authKey'    => [
            'type'       => VAR_TYPE_STRING,
            'name'       => '認証キー',
            'max'        => self::MAX_AUTH_KEY_LENGTH,
            'required'   => true,
        ],
    ];
}

class My_Action_AuthEventDo extends My_ActionClass
{
    public function prepare(): ?string
    {
        if ($this->af->validate() > 0) {
            return 'authEvent';
        }

        return null;
    }

    public function perform(): string
    {
        $eventManager = new My_EventManager($this->backend);
        $photos = $eventManager->getEventPhotosForAuthKey($this->af->get('authKey'));
        if (is_null($photos)) {
            $this->ae->add(null, '指定されたイベントは存在しません');
            return 'authEvent';
        }

        $this->af->setApp('eventPhoto', $photos);
        $this->af->setApp('eventName', $eventManager->getEventNameForAuthKey($this->af->get('authKey')));
        return 'eventView';
    }
}
