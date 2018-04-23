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
    const MAX_PHOTO_SIZE = 5000000;
    public $form = [
        'openDay'    => [
            'type'       => VAR_TYPE_STRING,
            'name'       => '公開開始日',
            'required'   => true
        ],

        'endDay' => [
            'type'     => VAR_TYPE_STRING,
            'name'     => '公開終了日',
            'custom'     => 'isPublishingPeriodIsStartDateThanEndDateTarget',

            'required' => true
        ],

        'eventName' => [
            'type'     => VAR_TYPE_STRING,
            'name'     => 'イベント名',
            'required' => true
        ],

        'eventId' => [
            'type'     => VAR_TYPE_INT,
            'name'     => 'eventId',
            'required' => true
        ],

        'photos' => [
            'type'       => [VAR_TYPE_FILE],
            'form_type'  => FORM_TYPE_FILE,
            'name'       => '写真',
            'custom'     => 'checkFile',
        ],
    ];

    /**
     *  各写真の容量とjpegかどうかをチェック
     *
     *  @access private
     *  @param  string $photos フォームの項目名
     *
     */
    public function checkFile(string $photos)
    {
        if (! is_uploaded_file($this->form_vars[$photos][0]['tmp_name'])) {
            return null;
        }

        foreach ($this->form_vars[$photos] as $photo) {
            if ($photo['size'] > self::MAX_PHOTO_SIZE) {
                $this->ae->add(null, '各画像サイズは5MB以下にしてください。');
            }

            if (exif_imagetype($photo['tmp_name']) !== IMAGETYPE_JPEG) {
                $this->ae->add(null, 'アップロードできるファイルはjpegのみです。');
            }
        }
    }

    /**
     *  イベントの日付が公開開始日より公開終了日が前になっていないかチェック
     *
     *  @access private
     *  @param  string $openDay フォームの項目名
     *
     */
    public function isPublishingPeriodIsStartDateThanEndDateTarget()
    {
        if (new DateTime($this->form_vars['openDay']) > new DateTime($this->form_vars['endDay'])) {
            $this->ae->add(null, 'イベントの公開期間は公開開始日よりも公開終了日が後に来るようにしてください。');
        }
    }
}

class My_Action_UpdateEvent extends My_LoginActionClass
{

    public function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'error';
        }

        $eventId = $this->af->get('eventId');
        if (! is_numeric($eventId)) {
            return 'error404';
        }

        $userId = $this->session->get('userInfo')[id];
        if (! (new My_EventManager($this->backend))->isEventOwnerCurrentUser($eventId, $userId)) {
            return 'error403';
        }

        return null;
    }

    public function perform()
    {
        $eventId = $this->af->get('eventId');
        $eventName = $this->af->get('eventName');
        $openDay = $this->af->get('openDay');
        $endDay = $this->af->get('endDay');
        $photos = $this->af->get('photos');

        (new My_EditManager($this->backend))->updateEvent($openDay, $endDay, $eventId, $eventName, $photos);
        header("Location: ?action_editEvent=true&id=$eventId");
        exit;
    }
}
