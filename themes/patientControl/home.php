<?php $v->layout("_base"); ?>

<div class="dados-container row" style="margin-left: 200px">
    <div style="margin-left: 50px; width: 165px">
        <p class="white-text">Pacientes Registrados</p>
        <div class="card-panel teal center">
        <span class="white-text"><?= $patients->countAll(); ?>
        </span>
        </div>
    </div>
    <div style="margin-left: 50px; width: 165px">
        <p class="white-text">Pacientes Consultados</p>
        <div class="card-panel teal center">
        <span class="white-text"><?= $patients->countAllWithAppointment(); ?>
        </span>
        </div>
    </div>
    <div style="margin-left: 50px; width: 165px">
        <p class="white-text">Pacientes sem Consulta</p>
        <div class="card-panel teal center">
        <span class="white-text"><?= $patients->countAllWithoutAppointment(); ?>
        </span>
        </div>
    </div>
</div>
