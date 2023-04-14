<?php /* Smarty version 2.6.18, created on 2023-02-23 12:32:24
         compiled from pagination.html */ ?>
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
    <center>

      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">SPI</a>
      
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php" style="font-weight: bold; color: antiquewhite;">Index <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes.php">Cliente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="servicios.php">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="asignaciones.php">Asignaciones</a>
          </li>
          
        </ul>
      </nav>
      <br>
        
      
      <div id="body">
       Bienvenido a pagination.
      </div>
    </center>
    <div id="table">


        <?php echo $this->_tpl_vars['cliente']; ?>


        <div class="container">
            <table id="myTable" class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Telefonico</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
                <!-- 
                    Ya tengo el Cuerpo de la tabla, ahora debo crear dinamicametne el resto Con un for each en smarty, aca le voy a enviar la data.
                    Para acceder al array con smarty es <?php echo $this->_tpl_vars['clientes'][1]['name']; ?>

                    A esto le deberia hacer un for each asique accedo mas facil
                -->
                <?php $_from = $this->_tpl_vars['clientes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cliente']):
?>
                    <tr id="<?php echo $this->_tpl_vars['cliente']['id']; ?>
" >
                        <td><?php echo $this->_tpl_vars['cliente']['id']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['cliente']['name']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['cliente']['apellido']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['cliente']['dir']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['cliente']['tel']; ?>
</td>
                        <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['cliente']['id']; ?>
"  class="editButton btn btn-light btn-sm" onclick="editUser('<?php echo $this->_tpl_vars['cliente']['id']; ?>
')">Edit</button></td>
                        <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['cliente']['id']; ?>
"  class="deleteButton btn btn-danger btn-sm" onclick="deleteUser('<?php echo $this->_tpl_vars['cliente']['id']; ?>
')">Borrar</button></td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
            
            
              </table>
            <div class="centerDiv">

                <?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
                    <?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['currentPage']): ?>
                        <strong><?php echo $this->_tpl_vars['page']; ?>
</strong>
                    <?php else: ?>
                        <a href="index.php?action=pagination&page=<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>


            <div class="centerDiv">
              <input type="button" id="hideListButton" class="btn btn-info" value="Hide List" onclick="hideList()">
            </div>
            
            </div>
    </div>

  </body>




  <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>
</html>