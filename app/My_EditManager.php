<?php
class My_EditManager extends Ethna_AppManager
{
    const IMAGE_PATH = './sherImage';

    /**
     *  指定された写真をDBとディレクトリから削除する
     *
     *  @param photoNames array
     */
    public function deletePhotos(array $photosId)
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
     *  @param  string $openDay
     *  @param  string $endDay
     *  @param  int $eventId
     *  @param  string $eventName
     *  @param  array $photos
     *
     *  @return void
     */
    public function updateEvent(string $openDay, string $endDay, int $eventId, string $eventName, array $photos)
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
