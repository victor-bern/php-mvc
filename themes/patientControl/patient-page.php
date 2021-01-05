<?php $v->layout("_base"); ?>

<?php $cropper = new \Source\Support\Images(); ?>


<div class="white dados-container" style="padding: 30px">
    <div>
        <img src="<?= storage("images/{$patient->image}"); ?>" alt="" class="image">
    </div>
    <div class="info">
        <div>
            <label>Paciente</label>
            <p><?= $patient->name ?></p>
        </div>
        <div>
            <label>Email</label>
            <p><?= $patient->email ?></p>
        </div>

        <div>
            <label>Sintomas</label>
            <p><?= $patient->symptoms ?></p>
        </div>
        <div>
            <label>Já se consultou?</label>
            <?php if ($patient->appointment == 0) : ?>
                <p>Não</p>
            <?php else: ?>
                <p>Sim</p>
            <?php endif; ?>
        </div>
    </div>

</div>

