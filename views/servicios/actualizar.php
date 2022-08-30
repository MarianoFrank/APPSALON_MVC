<h1 class="nombre-pagina">Actualizar Servicio</h1>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<p class="descripcion-pagina">Llene los campos para actualizar</p>

<form class="formulario" method="POST">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="btn" value="Actualizar Servicio">
</form>

<?php 
$script = "<script src='/build/js/servicios.js'> </script>";
?>