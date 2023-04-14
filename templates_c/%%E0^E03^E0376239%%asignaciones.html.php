<?php /* Smarty version 2.6.18, created on 2023-02-28 15:56:02
         compiled from asignaciones.html */ ?>


  <script async src="includes/js/asignaciones.js"></script>
 
    <center>
      <div id="body">
        Bienvenido a asigancioens.
       </div>
     </center>
     <div id="clientesDropdownDiv" class="d-flex justify-content-center" >
      Seleccione un cliente:
      <select id="clientesDropdown" name="clientesDropdown">
        <!-- aca tendria el for each para los clientes
        PERO EL VALUE TIENE QUE SER EL ID ASI DSP MADNO ESO y el anme EL NAME MAS APELLIDO-->
        <option value="" selected disabled hidden>Seleccione el cliente</option>
        <?php $_from = $this->_tpl_vars['clientes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cliente']):
?>
          <option value="<?php echo $this->_tpl_vars['cliente']['id']; ?>
"><?php echo $this->_tpl_vars['cliente']['fullname']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
   

     </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-primary" onclick="getServicios()">Buscar</button>
    </div>

    <div id="serviceListAsignaciones">

    </div>