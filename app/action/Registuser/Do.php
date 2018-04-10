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
        'mailaddress' => [
            'type' => VAR_TYPE_STRING,
            'name'   => 'メールアドレス',
            'required'   => true,
        ],
        'password1' => [
            'type' => VAR_TYPE_STRING,
            'name'   => 'パスワード１',
            'required'   => true,
        ],
        'password2' => [
            'type' => VAR_TYPE_STRING,
            'name'   => 'パスワード２',
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

        $result = (new My_RegistManager)->checkPassword($password1, $password2);
        if (Ethna::isError($result)) {
            $this->ae->addObject(null, $result);
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
         return 'registuser';
    }
}
