<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<?php if (isset($alertas['arriba'])) : ?>
    <label class="<?php echo $alertas['arriba']['tipo']; ?>"><?php echo $alertas['arriba']['mensaje']; ?></label>
<?php endif; ?>



<form class="formulario" method="POST" action="/newacount">
    <div class="input-flex">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input class="<?php if (isset($alertas['nombre'])) {
                                echo "bordeAlerta";
                            } ?>" type="text" id="nombre" placeholder="Tu nombre" name="nombre" value="<?php echo s($usuario->nombre); ?>">

            <?php if (isset($alertas['nombre'])) : ?>
                <label class="alerta"><?php echo $alertas['nombre']; ?></label>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="apellido">Apellido</label>
            <input class="<?php if (isset($alertas['apellido'])) {
                                echo "bordeAlerta";
                            } ?>" type="text" id="apellido" placeholder="Tu apellido" name="apellido" value="<?php echo s($usuario->apellido); ?>">
            <?php if (isset($alertas['apellido'])) : ?>
                <label class="alerta"><?php echo $alertas['apellido']; ?></label>
            <?php endif; ?>
        </div>
    </div>

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

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input class="<?php if (isset($alertas['telefono'])) {
                            echo "bordeAlerta";
                        } ?>" type="tel" id="telefono" placeholder="Tu telefono" name="telefono" value="<?php echo s($usuario->telefono); ?>">
        <?php if (isset($alertas['telefono'])) : ?>
            <label class="alerta"><?php echo $alertas['telefono']; ?></label>
        <?php endif; ?>
    </div>

    <input type="submit" class="btn" value="Crear cuenta">

</form>

<div class="acciones">
    <a href="/">Inicia Sesión</a>
    <a href="/repass">Olvidaste tu password ?</a>
</div>