<?php /* Smarty version 2.6.18, created on 2023-02-28 12:45:57
         compiled from form.html */ ?>
<!--
    FROM HTML
    Tener en cuenta que voy a fusionar los dos forms, esto no seria REGISTER y otro EDIT, serian el mismo.
    tengo que usar SMARTY para hacer eficiente el codigo
    cosas a tener en cuenta
    {if == edit disable}   -> para el input de ID por ejemplo.
    dsp value={campo.de.input.que.corresponda}  -> esto es porque si llego y estoy EDITANDO el value ya esta pero si estoy registrando esta vacio
    el submit tmb en el smarty le asigno {} o {}

    value {id}

    puedo poenr DIABEL TRUE en el dit
-->

<?php if ($this->_tpl_vars['formNeeded'] == 'clientes'): ?>
<div class="container">
    <form action="javascript:void(0);" onsubmit="guardar('<?php echo $this->_tpl_vars['operacion']; ?>
')">
    <div class="form-group registerForm">
       
        <input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nombre:</label>
                <input class="form-control" type="text" id="name" pattern="^[a-zA-Z]+$" name="name" value="<?php echo $this->_tpl_vars['name']; ?>
" required>
            </div>

            <div class="form-group col-md-6">
                <label for="apellido">Apellido:</label>
                <input class="form-control" type="text" id="apellido" pattern="^[a-zA-Z]+$" name="apellido" value="<?php echo $this->_tpl_vars['apellido']; ?>
" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="dir">Dirección:</label>
                <input class="form-control" type="text" id="dir" name="dir" value="<?php echo $this->_tpl_vars['dir']; ?>
" required>
            </div>

            <div class="form-group col-md-6">
                <label for="tel">Tel:</label>
                <input class="form-control" type="number" id="tel" name="tel" pattern="^\d+$" value="<?php echo $this->_tpl_vars['tel']; ?>
" required>
            </div>
        </div>
        <button type='submit' class="btn btn-primary">Cargar</button>
    </form>
    </div>
    <div class="centerDiv">
        <button class="btn btn-primary" onclick="esconderRegistro()">Esconder Registro</button>
    </div>
</div>
<?php endif; ?>

<!--
    Y ACA VOY A ARMAR EL FORM PARA DAR DE ALTA UNSERVICIO
-->


<?php if ($this->_tpl_vars['formNeeded'] == 'servicios'): ?>
<div class="container">
    <form action="javascript:void(0);" onsubmit="guardar('<?php echo $this->_tpl_vars['operacion']; ?>
')">
    <div class="form-group registerForm">
        
        <input type="hidden" id="id" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
"/>

        <div class="form row">
            <div class="col-md-4 offset-md-4">
                <label for="name">Nombre:</label>
                <input class="form-control" type="text" id="name" name="name" value="<?php echo $this->_tpl_vars['name']; ?>
" style="justify-content: center;" required>
            </div>
        </div>

        <div class="form row">
            <div class="form-group col-md-4 offset-md-2">
                <label for="vdescarga">Vdescarga:</label>
                <input class="form-control" type="number" id="vdescarga" name="vdescarga" pattern="^\d+$" value="<?php echo $this->_tpl_vars['vdescarga']; ?>
" required>
            </div>

            <div class="form-group col-md-4">
                <label for="vsubida">Vsubida:</label>
                <input class="form-control" type="number" id="vsubida" name="vsubida" pattern="^\d+$" value="<?php echo $this->_tpl_vars['vsubida']; ?>
" required>
            </div>
        </div>
        <button type='submit' class="btn btn-primary">Cargar</button>
    </form>
    </div>
    <div class="centerDiv">
        <button class="btn btn-primary" onclick="esconderRegistro()">Esconder Registro</button>
    </div>
</div>
<?php endif; ?>