<?php /* Smarty version 2.6.18, created on 2023-02-09 15:58:18
         compiled from edit.html */ ?>
<div class="container">
    <form action="javascript:void(0);" onsubmit="edit()">
    <div class="form-group registerForm">
   
        <h2>Edit User:</h2>
        <label for="id">ID:</label>
        <input type="number" id="idEdit" name="id" disabled>

        <label for="name">Name:</label>
        <input type="text" id="nameEdit" name="name" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellidoEdit" name="apellido" required>

        <label for="dir">Dirección:</label>
        <input type="text" id="dirEdit" name="dir">

        <label for="tel">Tel:</label>
        <input type="number" id="telEdit" name="tel">

    </div>
    <div class="centerDiv">
        <button type='submit' class="btn btn-primary">Editar Cliente</button>
    </div>
    </form>
    
    <div class="centerDiv">
        <button class="btn btn-primary" onclick="esconderEdit()">Cancelar Edit</button>
    </div>
</div>
    
    
    <!-- Esta funcion hace un fetch al case addClient y de ahi me manejo, la idea
    es cargar esto en el archivo/db y dsp alert si esta todo ok o not ok -->