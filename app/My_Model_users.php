<?php
class My_Model_users
{
    private $backend;

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
     * メールアドレスからuserIdを取得する
     *
     * @access public
     * @param  $mailaddress
     *
     * @return array
     */
    public function getUserId(string $mailaddress): array
    {
        $mailaddress = pg_escape_string($mailaddress);
        return $this->backend->getDB()->query("SELECT id FROM users WHERE mailaddress = '$mailaddress';")->getRows();
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
        $mailaddress = pg_escape_string($mailaddress);
        $password = hash('sha256', pg_escape_string($password));
        $this->backend->getDB()->query(
            "INSERT INTO users (id, mailaddress, password)
                    VALUES (nextval('user_id'), '$mailaddress', '$password');"
        );
    }
}
