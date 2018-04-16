<?php
class My_ModelEvents
{
    private $backend;
    private $db;

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
        $this->db = $this->backend->getDB();
    }

    /**
     *  イベントを作成する
     *
     *  @param  $userId
     *
     *  @return void
     */
    public function createEvent($userId, $openDay, $endDay, $eventName)
    {
        $sql = "
            INSERT INTO events (open_day, end_day, event_name, user_id, auth_key)
                 VALUES (?, ?, ?, ?, ?
        )";

        do {
            $openDay = (new DateTime($openDay))->format('Y-m-d H:i:s');
            $endDay = (new DateTime($endDay))->format('Y-m-d H:i:s');
            $result = $this->db->getAssoc($sql, [$openDay, $endDay, $eventName, $userId, $this->createAuthKey()]);
        } while ($result === false);
    }


    /**
     *  認証キーを作成する
     *
     *
     *  @return $authKey string
     */
    private function createAuthKey(): string
    {
        // 認証キー生成
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $authKey = '';
        for ($i = 0; $i < 9; $i++) {
            $authKey .= $str[rand(0, count($str) - 1)];
        }
        return $authKey;
    }

    /**
     *  userIdの最後に作成されたイベントを持ってくる
     *
     *  @param  $userId
     *
     *  @return int
     */
    public function getMyLastEventId(int $userId): int
    {
        $sql = "(
            SELECT id
            FROM events
            WHERE user_id = ?
            ORDER BY id DESC
        )";
        return $this->db->getOne($sql, [$userId]);
    }

    /**
     *  認証キーを取得する
     *
     *  @param $eventId int
     *
     *  @return AuthKey string
     */
    public function getAuthKey(int $eventId): string
    {
        $sql = "
            SELECT auth_key
              FROM events
             WHERE id = ?
        ";
        return $this->db->getOne($sql, [$eventId]);
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
        $sql = "
            SELECT *
              FROM events
             WHERE user_id = ?
        ";

        return $this->db->getAll($sql, $userId);
    }
}
