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
            'required' => true
        ],

        'endDay' => [
            'type' => VAR_TYPE_STRING,
            'name' => '公開終了日',
            'required' => true
        ],

        'eventName' => [
            'type' => VAR_TYPE_STRING,
            'name' => 'イベント名',
            'required' => true
        ],

        'eventId' => [
            'type' => VAR_TYPE_STRING,
            'name' => 'eventId',
            'required' => true
        ],

        'photos'      => [
            'type'       => [VAR_TYPE_FILE],
            'form_type'  => FORM_TYPE_FILE,
            'name'       => '写真',
            'custom'     => 'checkFile',
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

class My_Action_UpdateEvent extends My_LoginActionClass
{
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
}
