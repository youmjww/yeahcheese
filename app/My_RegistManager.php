<?php
class My_RegistManager
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
     *  パスワードのチェック用
     *
     *  @access public
     *  @param $password1 string
     *  @param $password2 string
     *
     *  @return null or Ethna::Error
     */
    public function checkPassword(string $password1, string $password2): ?\Ethna_Error
    {
        if ($password1 !== $password2) {
            return Ethna::raiseNotice('パスワードが一致しません。', E_CHECK_PASSWORD);
        }
        return null;
    }

    /**
     *
     * すでに登録されたメールアドレスかどうか
     *
     * @access public
     * @param $mailaddress string
     *
     * @return mixed null or Ethna::Error
     */
    public function isRegisteredMailaddress(string $mailaddress): ?\Ethna_Error
    {
        $mailaddress = pg_escape_string($mailaddress);
        $countMailaddress = (new My_ModelUsers($this->backend))->getUserId($mailaddress);
        if (count($countMailaddress)) {
            return Ethna::raiseNotice('すでに登録されているメールアドレスです。', E_REGISTERED_MAILADDRESS);
        }
        return null;
    }
}
