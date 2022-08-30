<h1 class="nombre-pagina">Panel de Administarción</h1>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<p class="descripcion-pagina">Buscar citas</p>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>

<?php
if (count($citas) === 0) {
    echo "<h2>No hay citas en esta fecha</h2>";
}
?>

<div class="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        foreach ($citas as $key => $cita) : ?>

            <?php if ($idCita !== $cita->id) :
                $total = 0;
            ?>
                <li class="li-cita">
                    <div class="contnedor-datos">
                        <div class="datos-cliente">
                            <p>ID: <span> <?php echo $cita->id; ?></span></p>
                            <p>Hora: <span> <?php echo $cita->hora; ?></span></p>
                            <p>Cliente: <span> <?php echo $cita->cliente; ?></span></p>
                            <p>Email: <span> <?php echo $cita->email; ?></span></p>
                            <p>Telefono: <span> <?php echo $cita->telefono; ?></span></p>

                        </div>

                        <form action="/api/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                            <input type="submit" class="btn eliminar" value="Eliminar">
                        </form>
                    </div>



                    <div class="contenedor-servicios">
                        <h3>Servicios </h3>
                    <?php $idCita = $cita->id;
                endif; ?>

                    <p class="servicio"> <?php echo $cita->servicio; ?><span><?php echo ' $' . $cita->precio; ?></span> </p>

                    <?php
                    $total += $cita->precio;
                    $actual = $cita->id;
                    $proximo = $citas[$key + 1]->id ?? 0;
                    if (esUltimo($actual, $proximo)) : ?>
                        <div class="total">
                            <p>Total a pagar: <span><?php echo '$' . $total; ?></span></p>
                        </div>

                    </div>
                </li>
            <?php endif; ?>

        <?php endforeach; ?>
    </ul>
</div>

<?php
$script = "<script src='build/js/buscador.js'></script>"
?>