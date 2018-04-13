<?php
/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   My
 */

class My_Form_LoginDo extends My_ActionForm
{
    const MAX_PASSWORD_LENGTH = 16;
    const MIN_PASSWORD_LENGTH = 8;
    const MAX_MAILADDRESS_LENGTH = 256;
    /**
     *  @access   protected
     *
     *  @var      array   form definition.
     */
    public $form = [
        'mailaddress'    => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'メールアドレス',
            'max'        => self::MAX_MAILADDRESS_LENGTH,
            'custom'     => 'checkMailaddress',
            'required'   => true,
        ],
        'password'      => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'パスワード',
            'max'        => self::MAX_PASSWORD_LENGTH,
            'min'        => self::MIN_PASSWORD_LENGTH,
            'required'   => true,
        ],
    ];
}

/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    My
 */
class My_Action_LoginDo extends My_ActionClass
{
    /**
     *  preprocess login user action.
     *
     *  @access    public
     *  @return    string  Forward name (null if no errors.)
     */
    public function prepare(): ?string
    {
        if ($this->af->validate() > 0) {
            return 'login';
        }

        $checkPassword = (new My_LoginManager($this->backend))->checkPassword($this->af->get('password'), $this->af->get('mailaddress'));
        if (Ethna::isError($checkPassword)) {
            $this->ae->addObject(null, $checkPassword);
            return 'login';
        }
        return null;
    }

    /**
     *  Index login implementation.
     *
     *  @access    public
     *  @return    string  Forward Name.
     */
    public function perform(): string
    {
        $mailaddress = $this->af->get('mailaddress');
        $this->session->start();
        $userInfo = [
            'id'          =>  (new My_ModelUsers($this->backend))->getUserId($mailaddress)['id'],
            'mailaddress' =>  $mailaddress
        ];
        $this->session->set('userInfo', $userInfo);

        return 'home';
    }
}
