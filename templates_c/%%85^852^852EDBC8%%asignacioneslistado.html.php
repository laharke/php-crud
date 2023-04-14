<?php /* Smarty version 2.6.18, created on 2023-02-27 13:05:39
         compiled from asignacioneslistado.html */ ?>
<div class="d-flex justify-content-center">
        <h3>Servicios asignados al cliente:</h3>
</div>

<input type="hidden" value="<?php echo $this->_tpl_vars['clienteId']; ?>
" id="clienteIdHidden">
<div class="container">
    <table id="myTable" class="table table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>V Descarga</th>
            <th>V Subida</th>
            <th>Borrar de usuario</th>
        </tr>
        <!-- 
            Ya tengo el Cuerpo de la tabla, ahora debo crear dinamicametne el resto Con un for each en smarty, aca le voy a enviar la data.
            Para acceder al array con smarty es <?php echo $this->_tpl_vars['users'][1]['name']; ?>

            A esto le deberia hacer un for each asique accedo mas facil
        -->
        <?php $_from = $this->_tpl_vars['servicios']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['servicio']):
?>
            <tr id="<?php echo $this->_tpl_vars['servicio']['idServicio']; ?>
" >
                <td><?php echo $this->_tpl_vars['servicio']['idServicio']; ?>
</td>
                <td><?php echo $this->_tpl_vars['servicio']['nameServicio']; ?>
</td>
                <td><?php echo $this->_tpl_vars['servicio']['vdescarga']; ?>
</td>
                <td><?php echo $this->_tpl_vars['servicio']['vsubida']; ?>
</td>
                <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['servicio']['id']; ?>
" data-clienteId="<?php echo $this->_tpl_vars['clienteId']; ?>
" class="deleteButton btn btn-danger btn-sm" onclick="toogleServicio('<?php echo $this->_tpl_vars['servicio']['idServicio']; ?>
','<?php echo $this->_tpl_vars['clienteId']; ?>
', 'desasignar')">Desasignar</button></td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    
      </table>
    
    </div>

<div class="d-flex justify-content-center">
        <h3>Servicios <b>NO</b> asignados al cliente:</h3>
</div>
<div class="container">
    <table id="myTable" class="table table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>V Descarga</th>
            <th>V Subida</th>
            <th>Asignar a usuario</th>
        </tr>
        <!-- 
        -->
        <?php $_from = $this->_tpl_vars['serviciosFaltantes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['servicio']):
?>
            <tr id="<?php echo $this->_tpl_vars['servicio']['idServicio']; ?>
" >
                <td><?php echo $this->_tpl_vars['servicio']['idServicio']; ?>
</td>
                <td><?php echo $this->_tpl_vars['servicio']['nameServicio']; ?>
</td>
                <td><?php echo $this->_tpl_vars['servicio']['vdescarga']; ?>
</td>
                <td><?php echo $this->_tpl_vars['servicio']['vsubida']; ?>
</td>
                <td class="centerDiv"><button data-id="<?php echo $this->_tpl_vars['servicio']['id']; ?>
" data-clienteId="<?php echo $this->_tpl_vars['clienteId']; ?>
" class="deleteButton btn btn-danger btn-sm"  onclick="toogleServicio('<?php echo $this->_tpl_vars['servicio']['idServicio']; ?>
','<?php echo $this->_tpl_vars['clienteId']; ?>
', 'asignar')">Asignar</button></td>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    
    
      </table>
    
    </div>