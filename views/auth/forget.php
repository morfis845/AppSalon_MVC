<h1 class="name-page">Olvide la contraseña</h1>
<?php foreach($alerts as $key => $value): ?>
    <div class="alert <?php echo s($key); ?>"><?php echo s($value[$key]); ?></div>
<?php endforeach;  ?>
<form action="/forget" method="POST" class="form">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu email">
    </div>
    <input type="submit" class="button" value="Cambiar Contraseña">
</form>
<div class="actions">
    <a href="/register">¿Aún no tienes una cuenta? Crear Una</a>
    <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
</div>