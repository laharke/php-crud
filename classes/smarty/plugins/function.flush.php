<?php
function smarty_function_flush($params,$template){
   echo ob_get_clean();
   flush();
   ob_start();
   return;
}
?>
