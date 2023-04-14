<?php /* Smarty version 2.6.18, created on 2023-02-08 15:23:24
         compiled from register.html */ ?>
<div class="container">
    <form action="javascript:void(0);" onsubmit="agregar()">
    <div class="form-group registerForm">
        <div class="idForm col-xs-2">
            <label for="id">ID:</label>
            <input class="form-control" type="number" id="id" name="id" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nombre:</label>
                <input class="form-control" type="text" id="name" pattern="^[a-zA-Z]+$" name="name" required>
            </div>

            <div class="form-group col-md-6">
                <label for="apellido">Apellido:</label>
                <input class="form-control" type="text" id="apellido" pattern="^[a-zA-Z]+$" name="apellido" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="dir">Dirección:</label>
                <input class="form-control" type="text" id="dir" name="dir" required>
            </div>

            <div class="form-group col-md-6">
                <label for="tel">Tel:</label>
                <input class="form-control" type="number" id="tel" name="tel" pattern="^\d+$" required>
            </div>
        </div>
        <button type='submit' class="btn btn-primary">Cargar Cliente</button>
    </form>
    </div>
    <div class="centerDiv">
        <!--
        Este boton no lo necestio mas porqeu ahora agrege el ON SUBMIT y cumple la misma funcion epro ademas me chqeua el pattern
        <button class="btn btn-primary" onclick="agregar()">Cargar Cliente</button>
        -->
        <button class="btn btn-primary" onclick="esconderRegistro()">Esconder Registro</button>
    </div>
</div>
    
    
    <!-- Esta funcion hace un fetch al case addClient y de ahi me manejo, la idea
    es cargar esto en el archivo/db y dsp alert si esta todo ok o not ok -->