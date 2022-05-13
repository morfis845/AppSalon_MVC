<h1 class="name-page">login</h1>

<?php foreach ($alerts as $alert) : ?>
        <?php if (isset($alert['error'])) : ?>
            <div class="alert error">
                <?php echo $alert['error']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

<form action="/" class="form" method="POST">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo s($emailPlaceHolder); ?>">
    </div>
    <?php foreach ($alerts as $alert) : ?>
        <?php if (isset($alert['email'])) : ?>
            <div class="alert error">
                <?php echo $alert['email']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="field">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu Contraseña" name="password">
    </div>
    <?php foreach ($alerts as $alert) : ?>
        <?php if (isset($alert['password'])) : ?>
            <div class="alert error">
                <?php echo $alert['password']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" value="Iniciar Sesión" class="button">
</form>
<div class="actions">
    <a href="/register">¿Aún no tienes una cuenta? Crear Una</a>
    <a href="/forget">Olvide mi contraseña</a>
</div>