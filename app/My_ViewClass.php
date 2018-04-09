<?php
// vim: foldmethod=marker
/**
 *  My_ViewClass.php
 *
 *  @author     {$author}
 *  @package    My
 */

// {{{ My_ViewClass
/**
 *  View class.
 *
 *  @author     {$author}
 *  @package    My
 *  @access     public
 */
class My_ViewClass extends Ethna_ViewClass
{
    /**#@+
     *  @access protected
     */

    /** @var  string  set layout template file   */
    protected $_layout_file = 'layout';

    /**#@+
     *  @access public
     */

    /** @var boolean  layout template use flag   */
    public $use_layout = true;

    /**
     *  set common default value.
     *
     *  @access protected
     *  @param  object  My_Renderer  Renderer object.
     */
    protected function _setDefault($renderer)
    {
    }

}
// }}}

