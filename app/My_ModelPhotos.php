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
    public function savePhoto(int $eventId, string $photoName)
    {
        $sql = "
            INSERT INTO photos (event_id, name)
                 VALUES (?, ?)
        ";
        $this->db->getAssoc($sql, [$eventId, $photoName]);
    }
}
