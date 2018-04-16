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

    public function createEvent($userId, $openDay, $endDay, $eventName)
    {
        $sql = "
            INSERT INTO events (open_day, end_day, event_name, user_id, auth_key)
                 VALUES (?, ?, ?, ?, ?
        )";

        do {
            $result = $this->db->getAssoc($sql, [$openDay . ' 00:00:00', $endDay . ' 00:00:00', $eventName, $userId, $this->createAuthKey()]);
        } while ($result === false);
    }

    private function createAuthKey() {
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
}
