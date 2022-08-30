<h1 class="nombre-pagina">Reestablecer contraseña</h1>
<p class="descripcion-pagina">Le enviaremos las instrucciones a su mail</p>

<?php if (isset($alertas['arriba'])) : ?>
    <label class="<?php echo $alertas['arriba']['tipo']; ?>"><?php echo $alertas['arriba']['mensaje']; ?></label>
<?php endif; ?>

<form class="formulario" method="POST" action="/repass">
    <div class="campo">
        <label for="email">Email</label>
        <input class="<?php if (isset($alertas['email'])) {
                            echo "bordeAlerta";
                        } ?>" type="email" id="email" placeholder="Tu email" name="email">
        <?php if (isset($alertas['email'])) : ?>
            <label class="alerta"><?php echo $alertas['email']; ?></label>
        <?php endif; ?>
    </div>

    <input type="submit" class="btn" value="Enviar">
</form>

<div class="acciones">
    <a href="/">Click aqui para iniciar sesión</a>
</div>