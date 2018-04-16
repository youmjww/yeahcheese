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

        // ループの中で何回も実行すると、トラフィックの無駄なのでここで実行しておく
        $eventId = $modelEvents->getMyLastEventId($userId);
        foreach ($photos as $photo) {
            // 画像を公開フォルダに保存
            $photoPath = tempnam(self::IMAGE_PATH, $userId);
            rename($photo['tmp_name'], $photoPath);

            (new My_ModelPhotos($this->backend))->savePhoto($eventId, basename($photoPath));
        }
    }
}
