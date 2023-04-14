<?php /* Smarty version 2.6.18, created on 2023-02-10 17:26:17
         compiled from index2.html */ ?>
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
    <script async src="includes/js/example.js"></script>
    <link rel="stylesheet" href="/php-smarty/example1/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  
  <body>  
    <?php echo $_GET['action']; ?>

    <center>
      <div>

        <a href="clientes.php"> clientes</a>
        <a href="servicios.php"> servicios</a>
        <a href="asignaciones.php"> asignaciones</a>
        
      </div>
      <div id="body">
       <?php echo $this->_tpl_vars['variable']; ?>

      </div>
    </center>
    <div id="register"></div>

    <div id="table"></div>

    <div id="edit"></div>
  </body>




  <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>
</html>