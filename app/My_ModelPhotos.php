<?php
class My_ModelPhotos
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
     *  写真の情報をDBへ保管する
     *
     *  @param  $photoName
     *  @param  $eventId
     *
     *  @return void
     */
    public function savePhoto(int $eventId, string $photoName): void
    {
        $sql = "
            INSERT INTO photos (event_id, name)
                 VALUES (?, ?)
        ";
        $this->db->getAssoc($sql, [$eventId, $photoName]);
    }

    /**
     *  イベントごとの写真枚数を取得
     *
     *  @param id int
     */
    public function getPhotoCount($eventId): int
    {
        $sql = "
            SELECT id
            FROM photos
            WHERE event_id = ?
        ";
        return count($this->db->getAll($sql, $eventId));
    }
}
