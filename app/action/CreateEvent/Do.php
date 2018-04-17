<?php

class My_Form_CreateEventDo extends My_ActionForm
{
    const MAX_EVENT_NAME_LENGTH = 30;
    const DATE_TYPE = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
    const MAX_PHOTO_SIZE = 5000000;

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
            'regexp'     =>  self::DATE_TYPE,
            'required'   => true,
        ],
        'endDay'      => [
            'type'       => VAR_TYPE_DATETIME,
            'name'       => '公開終了日',
            'regexp'     =>  self::DATE_TYPE,
            'required'   => true,
        ],
        'photos'      => [
            'type'       => [VAR_TYPE_FILE],
            'form_type'  => FORM_TYPE_FILE,
            'name'       => '写真',
            'custom'     => 'checkFile',
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
    public function checkFile($photos)
    {
        foreach ($this->form_vars[$photos] as $photo) {
            if ($photo['size'] > self::MAX_PHOTO_SIZE) {
                $this->ae->add(null, '各画像サイズは5MB未満にしてください。');
            }

            if (exif_imagetype($photo['tmp_name']) !== IMAGETYPE_JPEG) {
                $this->ae->add(null, 'アップロードできるファイルはjpegのみです。');
            }
        }
    }
}

class My_Action_CreateEventDo extends My_LoginActionClass
{
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

    public function perform(): string
    {
        $photos = $this->af->get('photos');
        $userId = $this->session->get('userInfo')['id'];
        $openDay = $this->af->get('openDay');
        $endDay = $this->af->get('endDay');
        $eventName = $this->af->get('eventName');

        $eventId = (new My_EventManager($this->backend))->uploadPhotos($photos, $userId, $openDay, $endDay, $eventName);
        $this->af->setApp('authKey', (new My_ModelEvents($this->backend))->getAuthKey($eventId));
        return 'successEvent';
    }
}
