<div class="bar">
    <p>Hola: <?php echo $name ?? ''; ?></p>
    <a href="/logout" class="button">Cerrar Sesión</a>
</div>
<?php if(isset($_SESSION['admin'])) : ?>
    <div class="service-bar">
        <a class="button" href="/admin">Ver Citas</a>
        <a class="button" href="/services">Ver Servicios</a>
        <a class="button" href="/services/create">Nuevo Servicio</a>
    </div>
<?php endif; ?>

