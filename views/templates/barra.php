<div class="barra">
    <p>
        Hola, <?php echo $nombre ?? ''; ?>
    </p>

    <a href="/logout" class="logout">Cerrar Sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) : ?>

    <div class="barra-servicios">
        <a class="btn btnAdmin" href="/admin">Ver citas</a>
        <a class="btn btnAdmin" href="/servicios">Ver servicios</a>
        <a class="btn btnAdmin" href="/servicios/crear">Crear servicio</a>
    </div>

<?php endif; ?>