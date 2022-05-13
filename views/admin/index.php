<?php include_once __DIR__ . '/../templates/bar.php'; ?>
<h1 class="name-page">Panel de Administracion</h1>
<h2>Buscar Citas</h2>
<div class="search">
    <form action="" class="form">
        <div class="field">
            <label for="date">Fecha</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>">
        </div>
    </form>
</div>

<?php 

    if(count($meetings) === 0){
        echo "<h2>No hay citas en esta fecha</h2>";
    }

?>

<div class="meetings-admin">
    <ul class="meetings">
        <?php
        $meetingId = '';
        foreach ($meetings as $key => $meeting) :
            if ($meetingId !== $meeting->id) :
                $total = 0;
        ?>
                <li>
                    <p>ID: <span><?php echo $meeting->id ?></span></p>
                    <p>Hora: <span><?php echo $meeting->hour ?></span></p>
                    <p>Client: <span><?php echo $meeting->client ?></span></p>
                    <p>Email: <span><?php echo $meeting->email ?></span></p>
                    <p>Phone: <span><?php echo $meeting->phone ?></span></p>

                    <h3>Servicios</h3>
                <?php
                $meetingId = $meeting->id;
            endif; 
                $total += $meeting->price;
            ?>
                <p class="service"><?php echo $meeting->service . ' ' . $meeting->price; ?></p>
               <?php
                $current = $meeting->id;
                $next = $meetings[$key + 1]->id ?? 0;
                if(isLast($current, $next)){ ?>
                     <p class="total">Total: <span>$<?php echo $total; ?></span></p>
                     <form action="/api/delete" method="POST">
                         <input type="hidden" name="id" value="<?php echo $meeting->id; ?>">
                         <input type="submit" class="button-delete" value="Eliminar">
                     </form>
                <?php }
               ?>
            <?php
        endforeach;  ?>
    </ul>
</div>
<?php 
$script = "<script src='build/js/search.js'></script>";
?>