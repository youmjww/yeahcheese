<?php
class My_LoginManager
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
     *  パスワードのチェック
     *
     *  @access public
     *  @param $password1 string
     *  @param $mailaddress string
     *
     *  @return null or Ethna::Error
     */
    public function checkPassword(string $password, string $mailaddress): ?\Ethna_Error
    {
        $hashPassword = (new My_ModelUsers($this->backend))->getUserPassword($mailaddress);
        if ($hashPassword !== hash('sha256', $password)) {
            return Ethna::raiseNotice('パスワード又はメールアドレスが不正です', E_FAILED_LOGIN);
        }
        return null;
    }
}
