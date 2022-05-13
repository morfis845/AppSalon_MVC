<h1 class="name-page">Confirmar Cuenta</h1>
<?php foreach ($alerts as $alert) : ?>
    <?php if (isset($alert['error'])) : ?>
        <div class="alert error">
            <?php echo s($alert['error']); ?>
        </div>
    <?php elseif (isset($alert['success'])) : ?>
        <div class="alert success">
            <?php echo s($alert['success']); ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
</div>