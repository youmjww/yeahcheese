<?php
class My_EventManager
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
     *
     * 公開ディレクトリに画像を移動
     *
     * @access public
     * @param  photos array
     *
     */
    public function savePhotos($photos, $userId, $openDay, $endDay, $eventName)
    {
        $modelEvents = new My_ModelEvents($this->backend);

        // イベント作成
        $modelEvents->createEvent($userId, $openDay, $endDay, $eventName);

        if (!file_exists(self::IMAGE_PATH)) {
            mkdir(self::IMAGE_PATH, 0777);
        }

        foreach ($photos as $photo) {
            // 画像を公開フォルダに保存
            $photoName = tempnam(self::IMAGE_PATH, $userId);
            rename($photo['tmp_name'], $photoName);

            // 画像の名前とパスをDBへ保存
        }
    }
}
