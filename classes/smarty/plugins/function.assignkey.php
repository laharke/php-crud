<?php
function smarty_function_assignkey($_params, &$_smarty) {

    if (!isset($_params['var'])) {
        $_smarty->trigger_error("assignkey: missing 'var' parameter", E_USER_ERROR, __FILE__, __LINE__);
        return;
    }
   
    if (!isset($_params['key'])) {
        $_smarty->trigger_error("assignkey: missing 'key' parameter", E_USER_ERROR, __FILE__, __LINE__);
        return;
    }

    if (isset($_smarty->_tpl_vars[$_params['var']]) && is_array($_smarty->_tpl_vars[$_params['var']])) {
      $var = $_smarty->_tpl_vars[$_params['var']];
    } else {
      $var = array();
    }

    $key = '["'.implode('"]["', explode('.', $_params['key'])).'"]';

    eval('$_smarty->_tpl_vars[$_params["var"]]'.$key.' = $_params["value"];');

    $var = $_smarty->_tpl_vars[$_params['var']];

    $_smarty->assign($_params['var'], $var);

}
?>