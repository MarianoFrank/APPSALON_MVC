<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesión con tu datos</p>

<?php if (isset($alertas['arriba'])) : ?>
    <label class="<?php echo $alertas['arriba']['tipo']; ?>"><?php echo $alertas['arriba']['mensaje']; ?></label>
<?php endif; ?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input class="<?php if (isset($alertas['email'])) {
                            echo "bordeAlerta";
                        } ?>" type="email" id="email" placeholder="Tu email" name="email" value="<?php echo s($usuario->email); ?>">
        <?php if (isset($alertas['email'])) : ?>
            <label class="alerta"><?php echo $alertas['email']; ?></label>
        <?php endif; ?>
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input class="<?php if (isset($alertas['password'])) {
                            echo "bordeAlerta";
                        } ?>" type="password" id="password" placeholder="Tu contraseña" name="password">
        <?php if (isset($alertas['password'])) : ?>
            <label class="alerta"><?php echo $alertas['password']; ?></label>
        <?php endif; ?>
    </div>

    <input type="submit" class="btn" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/newacount">Click aqui para crear cuenta</a>
    <a href="/repass">Olvidaste tu password ?</a>
</div>