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
        // 認証キー生成
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $authKey = '';
        for ($i = 0; $i < 9; $i++) {
            $authKey .= $str[rand(0, count($str) - 1)];
        }

        $sql = "
            INSERT INTO events (open_day, end_day, event_name, user_id, auth_key)
                 VALUES (?, ?, ?, ?, ?
        )";
        $this->db->getAssoc($sql, [$openDay . ' 00:00:00', $endDay . ' 00:00:00', $eventName, $userId, $authKey]);
    }
}
