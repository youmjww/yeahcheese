<?php
/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   My
 */

class My_Form_RegistuserDo extends My_ActionForm
{
    /**
     *  @access   protected
     *
     *  @var      array   form definition.
     */
    public $form = [
        'mailaddress'    => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'メールアドレス',
            'max'        => 256,
            'custom'     => 'checkMailaddress',
            'required'   => true,
        ],
        'password1'      => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'パスワード１',
            'max'        => 16,
            'min'        => 8,
            'required'   => true,
        ],
        'password2'      => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'パスワード２',
            'max'        => 16,
            'min'        => 8,
            'required'   => true,
        ]
    ];
}

/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    My
 */
class My_Action_RegistuserDo extends My_ActionClass
{
    /**
     *  preprocess regist user action.
     *
     *  @access    public
     *  @return    string  Forward name (null if no errors.)
     */
    public function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'registuser';
        }

        $password1 = $this->af->get('password1');
        $password2 = $this->af->get('password2');
        $checkPassword = (new My_RegistManager)->checkPassword($password1, $password2);
        if (Ethna::isError($checkPassword)) {
            $this->ae->addObject(null, $checkPassword);
            return 'registuser';
        }

        $isRegisteredMailaddress = $this->isRegisteredMailaddress($this->af->get('mailaddress'));
        if (Ethna::isError($isRegisteredMailaddress)) {
            $this->ae->addObject(null, $isRegisteredMailaddress);
            return 'registuser';
        }

        return null;
    }

    /**
     *  Index action implementation.
     *
     *  @access    public
     *  @return    string  Forward Name.
     */
    public function perform()
    {
        $password = hash('sha256', $this->af->get('password1'));
        $this->insertUserData($this->af->get('mailaddress'), $password);
        return 'home';
    }

    /**
     *
     * すでに登録されたメールアドレスかどうか
     *
     * @access private
     * @param $mailaddress string
     *
     * @return mixed null or Ethna::Error
     */
    private function isRegisteredMailaddress($mailaddress)
    {
        $mailaddress = pg_escape_string($mailaddress);
        $countMailaddress = $this->backend->getDB()->query("SELECT id FROM users WHERE mailaddress = '$mailaddress';")->getRows();
        if (count($countMailaddress)) {
            return Ethna::raiseNotice('すでに登録されているメールアドレスです。', E_REGISTERED_MAILADDRESS);
        }
    }

    /**
     *
     * DBにユーザ情報を格納する
     *
     * @access private
     * @param mailaddress string
     * @param password string
     *
     * @return void
     */
    private function insertUserData($mailaddress, $password)
    {
        $mailaddress = pg_escape_string($mailaddress);
        $password = pg_escape_string($password);
        $this->backend->getDB()->query(
            "INSERT INTO
              users (id, mailaddress, password)
             VALUES (nextval('user_id'), '$mailaddress', '$password');"
        );
    }
}
