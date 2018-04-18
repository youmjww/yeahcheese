<?php
class My_EditManager
{
    private $backend;

    const IMAGE_PATH = './sherImage';

    /**
     *
     * backendへ値を入れるためのコンストラクタ
     *
     * @access public
     * @param  &$backend
     *
     */
    public function __construct(&$backend)
    {
        $this->backend = $backend;
    }

    /**
        *  指定された写真をDBとディレクトリから削除する
        *
        *  @param photoNames array
     */
    public function deletePhotos($photosId)
    {
        foreach ($photosId as $photoId) {
            $modelPhotos = new My_ModelPhotos($this->backend);
            $photoName = $modelPhotos->getPhotoName($photoId);
            unlink("sherImage/$photoName");
            $modelPhotos->delPhoto($photoId);
        }
    }

    /**
     *  イベント情報を更新する
     *
     *  @param  $openDay
     *  @param  $endDay
     *  @param  $eventId
     *  @param  $eventName
     *  @param  $photos
     *
     *  @return void
     */
    public function updateEvent($openDay, $endDay, $eventId, $eventName, $photos)
    {
        (new My_ModelEvents($this->backend))->updateEvent($openDay, $endDay, $eventId, $eventName);
        if (is_uploaded_file($photos[0]['tmp_name'])) {
            foreach ($photos as $photo) {
                // 画像を公開フォルダに保存
                $photoPath = tempnam(self::IMAGE_PATH, $userId);
                rename($photo['tmp_name'], $photoPath);

                (new My_ModelPhotos($this->backend))->savePhoto($eventId, basename($photoPath));
            }
        }
    }
}
