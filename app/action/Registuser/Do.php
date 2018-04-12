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
        'password1'      => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'パスワード１',
            'max'        => self::MAX_PASSWORD_LENGTH,
            'min'        => self::MIN_PASSWORD_LENGTH,
            'required'   => true,
        ],
        'password2'      => [
            'type'       => VAR_TYPE_STRING,
            'name'       => 'パスワード２',
            'max'        => self::MAX_PASSWORD_LENGTH,
            'min'        => self::MIN_PASSWORD_LENGTH,
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
    public function prepare(): ?string
    {
        if ($this->af->validate() > 0) {
            return 'registuser';
        }

        $registManager = new My_RegistManager($this->backend);
        $password1 = $this->af->get('password1');
        $password2 = $this->af->get('password2');
        $checkPassword = $registManager->checkPassword($password1, $password2);
        if (Ethna::isError($checkPassword)) {
            $this->ae->addObject(null, $checkPassword);
            return 'registuser';
        }

        $isRegisteredMailaddress = $registManager->isRegisteredMailaddress($this->af->get('mailaddress'));
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
    public function perform(): string
    {
        $mailaddress = $this->af->get('mailaddress');

        (new My_ModelUsers($this->backend))->insertUserData($mailaddress, $this->af->get('password1'));

        $this->session->start();
        $userInfo = [
            'mailaddress' =>  $mailaddress
        ];
        $this->session->set('userInfo', $userInfo);

        return 'home';
    }
}
