<h1 class="nombre-pagina">Nuevo Servicio</h1>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<p class="descripcion-pagina">Llena todos los campos para añadir nuevo servicio</p>

<form class="formulario" action="/servicios/crear" method="POST">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="btn" value="Guardar Servicio">
</form>

<?php 
$script = "<script src='/build/js/servicios.js'> </script>";
?>