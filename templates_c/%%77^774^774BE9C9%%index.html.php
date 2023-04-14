<?php /* Smarty version 2.6.18, created on 2023-02-28 12:53:01
         compiled from index.html */ ?>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=8" > <!-- IE8 mode -->
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="description" content="<?php echo @META_DESCRIPTION; ?>
">
    <meta name="keywords" content="<?php echo @META_KEYWORDS; ?>
">
    <title><?php echo @MSG_PAGE_TITLE; ?>
</title>
    <script src="includes/js/jquery/jquery.js"></script>
    <link rel="stylesheet" href="/php-smarty/crud/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e09b5770e3.js" crossorigin="anonymous"></script>


    <script async src="includes/js/clientes.js"></script>
  </head>


  <body>  
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index_navbar.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if ($this->_tpl_vars['template']): ?>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['template'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php else: ?>
      <div class='centerDiv'>
        Bienvenido al index.
      </div>
    <?php endif; ?>
    
    <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>


      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "index_footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </body>


</html>