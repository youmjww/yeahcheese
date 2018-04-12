<?php
class My_ModelUsers
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
     *
     * メールアドレスからuserIdを取得する
     *
     * @access public
     * @param  $mailaddress
     *
     * @return array
     */
    public function getUserId(string $mailaddress): array
    {
        $sql = "
            SELECT id
              FROM users
             WHERE mailaddress = ?
        ";

        return $this->db->getRow($sql, [$mailaddress]);
    }

    /**
     *
     * メールアドレスからハッシュ化されたパスワードを取得する
     *
     * @access public
     * @param  $mailaddress
     *
     * @return string or null
     */
    public function getUserPassword(string $mailaddress): ?string
    {
        $sql = "
            SELECT password
              FROM users
             WHERE mailaddress = ?
        ";

        return $this->db->getOne($sql, [$mailaddress]);
    }


    /**
     *
     * DBにユーザ情報を格納する
     *
     * @access public
     * @param mailaddress string
     * @param password string
     *
     * @return void
     */
    public function insertUserData(string $mailaddress, string $password): void
    {
        $password = hash('sha256', $password);
        $sql = "
            INSERT INTO users (id, mailaddress, password)
                 VALUES (nextval('user_id'), ?, ?)
        ";
        $this->db->getAssoc($sql, [$mailaddress, $password]);
    }
}
