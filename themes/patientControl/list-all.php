<?php $v->layout("_base"); ?>
<div class="dados-container row white" style="border-radius: 5px; padding: 10px">
    <?php if (!$patients) : ?>
        <h1 style="text-align: center">Sem Pacientes</h1>
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>Nome Do Paciente</th>
                <th>email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= $patient->name ?></td>
                    <td><?= $patient->email ?></td>
                    <td>
                        <button>
                            <a class="material-icons" href="<?= url("paciente/{$patient->id}") ?>">
                                perm_identity
                            </a>
                        </button>
                        <button>
                            <a class="material-icons modal-trigger" href="<?= url("consulta/{$patient->id}"); ?>">
                                done_outline</a>
                        </button>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>


