<?php $v->layout("_base"); ?>
<div class="row s12 center-align white z-depth-4" style="width: 400px; border-radius: 5px; padding: 20px;">
    <form class="col s12" action="" method="post" enctype="multipart/form-data" novalidate>
        <h4 style="margin-bottom: 40px">Registro de Paciente</h4>
        <?php if (!$patient->fail() && !empty($message)) : ?>
            <span class="badge new blue"><?= $message ?></span>
        <?php endif; ?>
        <?php if ($patient->fail() && !empty($message)): ?>
            <span class="badge new red"><?= $message ?></span>
        <?php endif; ?>
        <div class="row">
            <div class="input-field col s12">
                <input name="name" placeholder="Insira seu nome" id="first_name" type="text" class="validate">
                <label for="name">Nome</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input name="age" placeholder="Idade" id="age" type="number" class="validate">
                <label for="age">Idade</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input name="email" id="email" type="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea name="symptoms" id="Symptoms" class="materialize-textarea" cols="20"></textarea>
                <label for="Symptoms">Sintomas</label>
            </div>
        </div>
        <div class="col">
            <div class="left-align" style="margin-bottom: 20px">
                <label for="image">Imagem</label>
                <input name="image" id="image" type="file" class="validate" style="margin-top: 10px">
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit">Submit
            <i class="material-icons right">send</i>
        </button>

    </form>

</div>

