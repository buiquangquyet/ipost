<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.6
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Core;



// ------------------------------------------------------------------------

/**
 * Fieldset Class
 *
 * Define a set of fields that can be used to generate a form or to validate input.
 *
 * @package   Fuel
 * @category  Core
 */
class Exfieldset extends Fieldset
{
    /**
     * 指定fieldのラベル取得
     *
     * @param string $name field_name
     * @return string
     */
    public function label($name)
    {
        if ( ! empty($name) and $field = $this->field($name))
        {
            return $field->__get('label');
        }
    }

    /**
     * 指定fieldのvalue取得
     *
     * @param string $name field_name
     * @return string
     */
    public function value($name)
    {
        if ( ! empty($name) and $field = $this->field($name))
        {
            return $field->__get('value');
        }
    }

    /**
     * 指定fieldのdescription取得
     *
     * @param string $name field_name
     * @return string
     */
    public function description($name)
    {
        if ( ! empty($name) and $field = $this->field($name))
        {
            return $field->__get('description');
        }
    }

    /**
     * 指定fieldのエラーメッセージ取得
     *
     * @param string $name field_name
     * @return string
     */
    public function error_msg($name)
    {
        if ( ! empty($name) and $field = $this->field($name))
        {
            return $field->error() instanceof Validation_Error ? $field->error()->get_message() : null;
        }
    }
}
