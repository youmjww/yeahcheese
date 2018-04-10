<?php
class My_RegistManager
{
    /**
     *
     *  パスワードのチェック用
     *
     *  @access public
     *  @param $password1 string
     *  @param $password2 string
     */
    public function checkPassword($password1, $password2)
    {
        if ($password1 !== $password2) {
            return Ethna::raiseNotice('パスワードが一致しません。', E_CHECK_PASSWORD);
        }
        return null;
    }
}
