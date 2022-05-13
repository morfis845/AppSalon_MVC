<h1 class="name-page">Cambiar Contraseña</h1>
<p class="description-page">Coloca tu nueva contraseña</p>
<?php foreach($alerts as $key => $value): ?>
    <div class="alert <?php echo s($key);  ?>"><?php echo s($value[$key]); ?></div>
<?php endforeach; ?>
<?php if($error) return;?>
<form method="POST" class="form">
    <div class="field">
        <label for="password">Nueva Contraseña</label>
        <input type="password" id="password" name="password" placeholder="">
    </div>
    <input type="submit" class="button" value="Cambiar Contraseña">
</form>
<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Iniciar Sesión</a>
</div>