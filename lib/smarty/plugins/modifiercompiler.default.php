<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifierCompiler
 */
/**
 * Smarty defaults modifier plugin
 * Type:     modifier
 * Name:     defaults
 * Purpose:  designate defaults value for empty variables
 *
 * @link   http://www.smarty.net/manual/en/language.modifier.default.php defaults (Smarty online manual)
 * @author Uwe Tews
 *
 * @param array $params parameters
 *
 * @return string with compiled code
 */
function smarty_modifiercompiler_default($params)
{
    $output = $params[ 0 ];
    if (!isset($params[ 1 ])) {
        $params[ 1 ] = "''";
    }
    array_shift($params);
    foreach ($params as $param) {
        $output = '(($tmp = @' . $output . ')===null||$tmp===\'\' ? ' . $param . ' : $tmp)';
    }
    return $output;
}
