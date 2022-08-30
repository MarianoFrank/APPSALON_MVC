<h1 class="nombre-pagina">Reestablecer contraseña</h1>
<p class="descripcion-pagina">Introduzca su nueva clave</p>

<?php if (isset($alertas['arriba'])) : ?>
    <label class="<?php echo $alertas['arriba']['tipo']; ?>"><?php echo $alertas['arriba']['mensaje']; ?></label>
<?php endif; ?>

<form class="formulario" method="POST" action="/recover">
    <div class="campo">
        <label for="password">Password</label>
        <input class="<?php if (isset($alertas['password'])) {
                            echo "bordeAlerta";
                        } ?>" type="password" id="password" placeholder="Tu contraseña" name="password">
        <?php if (isset($alertas['password'])) : ?>
            <label class="alerta"><?php echo $alertas['password']; ?></label>
        <?php endif; ?>
    </div>

    <input type="submit" class="btn" value="Enviar">
</form>
