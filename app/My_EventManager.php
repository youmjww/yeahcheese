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
     *  @return array
     */
    public function getEventInfo(int $userId): array
    {
        $events = (new My_ModelEvents($this->backend))->getUserEvents($userId);
        return $this->formatPublishDay($this->setNumberOfPhoto($events));
    }

    /**
     *  イベント情報に写真の枚数を埋め込む
     *
     *  @param $events array
     *
     *  @return $events array
     */
    private function setNumberOfPhoto(array $events): array
    {
        foreach ($events as $key => $event) {
            $events[$key]['photo_count'] = (new My_ModelPhotos($this->backend))->getPhotoCount($event['id']);
        }
        return $events;
    }

    /**
     *  イベント情報の日付をフォーマット
     *
     *  @param $events array
     *
     *  @return $events array
     */
    private function formatPublishDay(array $events): array
    {
        foreach ($events as $key => $event) {
            $events[$key]['open_day'] = (new DateTime($event['open_day']))->format('Y/m/d');
            $events[$key]['end_day'] = (new DateTime($event['end_day']))->format('Y/m/d');
        }
        return $events;
    }

    /**
     *  イベント情報の日付をハイフン区切りでフォーマット
     *
     *  @param $events array
     *
     *  @return $events array
     */
    private function formatPublishDayOnHyphen(array $events): array
    {
        foreach ($events as $key => $event) {
            $events[$key]['open_day'] = (new DateTime($event['open_day']))->format('Y-m-d');
            $events[$key]['end_day'] = (new DateTime($event['end_day']))->format('Y-m-d');
        }
        return $events;
    }

    /**
     *  現在のユーザのイベントかどうか調べる
     *
     *  @param  eventId int
     *  @param  userId int
     *
     *  @return bool
     */
    public function isEventOwnerCurrentUser(int $eventId, int $userId): bool
    {
        if ((new My_ModelEvents($this->backend))->getEventOwner($eventId) === $userId) {
            return true;
        }
        return false;
    }

    /**
     *  イベントを取ってくる
     *
     *  @param $eventId int
     *
     *  @return void
     */
    public function getEvent(int $eventId)
    {
        return $this->formatPublishDayOnHyphen((new My_ModelEvents($this->backend))->getEvent($eventId));
    }

    /**
     *  イベントの写真を持ってくる
     *
     *  @param $eventId int
     *
     *  @return void
     */
    public function getEventPhotos(int $eventId)
    {
        return (new My_ModelPhotos($this->backend))->getEventPhoto($eventId);
    }
}
