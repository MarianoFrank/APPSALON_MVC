<div class="campo">

    <?php if (isset($alertas['arriba'])) : ?>
        <label class="<?php echo $alertas['arriba']['tipo']; ?>"><?php echo $alertas['arriba']['mensaje']; ?></label>
    <?php endif; ?>


    <label for="nombre">Nombre</label>
    <input class="<?php if (isset($alertas['nombre'])) {
                        echo "bordeAlerta";
                    } ?>" type="text" id="nombre" placeholder="Nombre servicio" name="nombre" value="<?php echo $servicio->nombre; ?>">

    <?php if (isset($alertas['nombre'])) : ?>
        <label class="alerta"><?php echo $alertas['nombre']; ?></label>
    <?php endif; ?>

    <label for="nombre">Precio</label>
    <input class="<?php if (isset($alertas['precio'])) {
                        echo "bordeAlerta";
                    } ?>" type="number" id="precio" placeholder="Precio servicio" name="precio" value="<?php echo $servicio->precio; ?>">

    <?php if (isset($alertas['precio'])) : ?>
        <label class="alerta"><?php echo $alertas['precio']; ?></label>
    <?php endif; ?>
</div>