<?php /* Smarty version 2.6.18, created on 2023-02-23 12:52:47
         compiled from listado.html */ ?>

<?php if ($this->_tpl_vars['listadoNeeded'] == 'clientes'): ?>

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
        Para acceder al array con smarty es <?php echo $this->_tpl_vars['users'][1]['name']; ?>

        A esto le deberia hacer un for each asique accedo mas facil
    -->
    <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
        <tr id="<?php echo $this->_tpl_vars['user']['id']; ?>
" >
            <td><?php echo $this->_tpl_vars['user']['id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['user']['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['user']['apellido']; ?>
</td>
            <td><?php echo $this->_tpl_vars['user']['dir']; ?>
</td>
            <td><?php echo $this->_tpl_vars['user']['tel']; ?>
</td>
            <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['user']['id']; ?>
"  class="editButton btn btn-light btn-sm" onclick="editUser('<?php echo $this->_tpl_vars['user']['id']; ?>
')">Edit</button></td>
            <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['user']['id']; ?>
"  class="deleteButton btn btn-danger btn-sm" onclick="deleteUser('<?php echo $this->_tpl_vars['user']['id']; ?>
')">Borrar</button></td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>


  </table>
<div class="centerDiv">
  <input type="button" id="hideListButton" class="btn btn-info" value="Hide List" onclick="hideList()">
</div>

</div>

<?php endif; ?>


<?php if ($this->_tpl_vars['listadoNeeded'] == 'servicios'): ?>

<div class="container">
<table id="myTable" class="table table-dark">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>V Descarga</th>
        <th>V Subida</th>
        <th>Editar</th>
        <th>Borrar</th>
    </tr>
    <!-- 
        Ya tengo el Cuerpo de la tabla, ahora debo crear dinamicametne el resto Con un for each en smarty, aca le voy a enviar la data.
        Para acceder al array con smarty es <?php echo $this->_tpl_vars['users'][1]['name']; ?>

        A esto le deberia hacer un for each asique accedo mas facil
    -->
    <?php $_from = $this->_tpl_vars['servicios']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['servicio']):
?>
        <tr id="<?php echo $this->_tpl_vars['servicio']['id']; ?>
" >
            <td><?php echo $this->_tpl_vars['servicio']['id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['servicio']['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['servicio']['vdescarga']; ?>
</td>
            <td><?php echo $this->_tpl_vars['servicio']['vsubida']; ?>
</td>
            <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['servicio']['id']; ?>
"  class="editButton btn btn-light btn-sm" onclick="editServiceInfo('<?php echo $this->_tpl_vars['servicio']['id']; ?>
')">Edit</button></td>
            <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['servicio']['id']; ?>
"  class="deleteButton btn btn-danger btn-sm" onclick="deleteService('<?php echo $this->_tpl_vars['servicio']['id']; ?>
')">Borrar</button></td>
        </tr>
    <?php endforeach; endif; unset($_from); ?>


  </table>
<div class="centerDiv">
  <input type="button" id="hideListButton" class="btn btn-info" value="Hide List" onclick="hideList()">
</div>

</div>

<?php endif; ?>