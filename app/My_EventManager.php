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
     * @param  $photos array
     * @param  $userId int
     * @param  $openDay string
     * @param  $endDay string
     * @param  $eventName string
     *
     * @return int
     *
     */
    public function uploadPhotos(array $photos, int $userId, string $openDay, string $endDay, string $eventName): int
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
        return $eventId;
    }

    /**
     *  イベント情報の取得
     *
     *  @param $userId int
     *
     *  @return eventInfo array
     */
    public function getEventInfo(int $userId): array
    {
        return $this->formatPublishDay($this->setPublishDay($userId));
    }

    /**
     *  イベント情報に公開期間を埋め込む
     *
     *  @param $userId int
     *
     *  @return eventInfo array
     */
    private function setPublishDay(int $userId): array
    {
        $events = (new My_ModelEvents($this->backend))->getEventInfo($userId);
        foreach ($events as $key => $event) {
            $events[$key]['photo_count'] = (new My_ModelPhotos($this->backend))->getPhotoCount($event['id']);
        }
        return $events;
    }

    /**
     *  イベント情報の日付をフォーマット
     *
     *  @param $eventInfo array
     *
     *  @return eventInfo array
     */
    private function formatPublishDay(array $eventInfo): array
    {
        foreach ($eventInfo as $key => $event) {
            $eventInfo[$key]['open_day'] = date_format(date_create($event['open_day']), 'Y/m/d');
            $eventInfo[$key]['end_day'] = date_format(date_create($event['end_day']), 'Y/m/d');
        }
        return $eventInfo;
    }
}
