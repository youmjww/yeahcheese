<?php
/**
 *  Index form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   My
 */

class My_Form_Registuser extends My_ActionForm
{
    /**
     *  @access   protected
     *
     *  @var      array   form definition.
     */
    public $form = [
        'mailaddress' => [
            'type' => VAR_TYPE_STRING,
        ],
        'password1' => [
            'type' => VAR_TYPE_STRING,
        ],
        'password2' => [
            'type' => VAR_TYPE_STRING,
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
class My_Action_Registuser extends My_ActionClass
{
    /**
     *  preprocess regist user action.
     *
     *  @access    public
     *  @return    string  Forward name (null if no errors.)
     */
    public function prepare()
    {
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
