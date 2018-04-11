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
        (new My_Model_users($this->backend))->insertUserData($this->af->get('mailaddress'), $this->af->get('password1'));
        return 'home';
    }
}
