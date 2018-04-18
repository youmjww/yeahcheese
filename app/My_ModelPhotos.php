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
     *
     *  @return int
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

    /**
     *  写真IDから写真名を取得
     *
     *  @param id int
     *
     *  @return array
     */
    public function getPhotoName($photoId): string
    {
        $sql = "
            SELECT name
              FROM photos
             WHERE id = ?
        ";
        return $this->db->getOne($sql, $photoId);
    }

    /**
     *  イベントの写真を取得
     *
     *  @param id int
     *
     *  @return array
     */
    public function getEventPhoto($eventId): array
    {
        $sql = "
            SELECT *
              FROM photos
             WHERE event_id = ?
        ";
        return $this->db->getAll($sql, $eventId);
    }

    /**
     *  指定されたファイル名の写真を削除する
     *
     *  @param $photoName string
     *
     */
    public function delPhoto(int $photoId)
    {
        $sql = "
            DELETE FROM photos
             WHERE id = ?
        ";
        $this->db->getAssoc($sql, $photoId);
    }
}
