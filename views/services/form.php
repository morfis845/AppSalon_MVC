<div class="field">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" placeholder="Nombre del Servicio" value="<?php echo $service->name; ?>">
</div>
<?php foreach ($alerts as $alert) : ?>
        <?php if (isset($alert['name'])) : ?>
            <div class="alert error">
                <?php echo $alert['name']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<div class="field">
    <label for="price">Precio</label>
    <input type="number" name="price" id="price" placeholder="Precio del Servicio" value="<?php echo $service->price; ?>">
</div>
<?php foreach ($alerts as $alert) : ?>
    <?php if (isset($alert['error'])) : ?>
        <div class="alert error">
            <?php echo $alert['error']; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>