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
            'required'   => true
        ],

        'endDay' => [
            'type'     => VAR_TYPE_STRING,
            'name'     => '公開終了日',
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

        'photos'      => [
            'type'       => [VAR_TYPE_FILE],
            'form_type'  => FORM_TYPE_FILE,
            'name'       => '写真',
            'custom'     => 'checkFile',
        ],
    ];
}

class My_Action_UpdateEvent extends My_LoginActionClass
{
    const MAX_PHOTO_SIZE = 5000000;

    public function prepare()
    {
        $userId = $this->session->get('userInfo')[id];
        $eventId = $this->af->get('eventId');


        if ($this->af->validate() > 0) {
            header("Location: ?action_editEvent=true&id=$eventId");
        }

        if (! is_numeric($eventId)) {
            return 'error404';
        }

        if (! (new My_EventManager($this->backend))->isEventOwnerCurrentUser($eventId, $userId)) {
            return 'error403';
        }

        return $this->checkFile($this->af->get('photos'), $this->af->get('eventId'));
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

        return null;
    }

    /**
     *  各写真の容量チェック
     *
     *  @access private
     *  @param  string $photos フォームの項目名
     *
     *  @return mixed void or null
     */
    private function checkFile($photos, $eventId)
    {
        if (! is_uploaded_file($photos[0]['tmp_name'])) {
            return null;
        }

        foreach ($photos as $photo) {
            if ($photo['size'] > self::MAX_PHOTO_SIZE) {
                $this->ae->add(null, '各画像サイズは5MB未満にしてください。');
                header("Location: ?action_editEvent=true&id=$eventId");
            }

            if (exif_imagetype($photo['tmp_name']) !== IMAGETYPE_JPEG) {
                $this->ae->add(null, 'アップロードできるファイルはjpegのみです。');
                header("Location: ?action_editEvent=true&id=$eventId");
            }
        }
    }
}
