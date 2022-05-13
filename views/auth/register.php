<h1 class="name-page">Crear una Cuenta</h1>

<?php foreach ($alerts as $alert) : ?>
    <?php if (isset($alert['passwordLenght'])) : ?>
        <div class="alert error">
            <?php echo $alert['passwordLenght']; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php foreach ($alerts as $alert) : ?>
    <?php if (isset($alert['exist'])) : ?>
        <div class="alert error">
            <?php echo $alert['exist']; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<form action="/register" method="POST" class="form">
    <div class="field">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" placeholder="Tu Nombre" value="<?php echo s($user->name); ?>">
    </div>
    <?php foreach ($alerts as $alert) : ?>
        <?php if (isset($alert['name'])) : ?>
            <div class="alert error">
                <?php echo $alert['name']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="field">
        <label for="lastName">Apellido</label>
        <input type="text" id="lastName" name="lastName" placeholder="Tu Apellido" value="<?php echo s($user->lastName); ?>">
    </div>
    <?php foreach ($alerts as $alert) : ?>
        <?php if (isset($alert['lastName'])) : ?>
            <div class="alert error">
                <?php echo $alert['lastName']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="field">
        <label for="phone">Teléfono</label>
        <input type="tel" id="phone" name="phone" placeholder="Tu Teléfono" value="<?php echo s($user->phone); ?>">
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu Email" value="<?php echo s($user->email); ?>">
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
        <input type="password" id="password" name="password" placeholder="Tu Contraseña">
    </div>
    <?php foreach ($alerts as $alert) : ?>
        <?php if (isset($alert['password'])) : ?>
            <div class="alert error">
                <?php echo $alert['password']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" value="Crear tu cuenta" class="button">
</form>
<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
</div>