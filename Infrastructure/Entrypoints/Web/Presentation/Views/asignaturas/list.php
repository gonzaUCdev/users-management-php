<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de asignaturas</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (empty($asignaturas)): ?>
    <p>No hay asignaturas registradas todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Carrera</th>
                <th>Créditos</th>
                <th>Semestre</th>
                <th>Profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asignaturas as $asignatura): ?>
                <tr>
                    <td><?= htmlspecialchars($asignatura->getNombre(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($asignatura->getCarrera(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= (int) $asignatura->getNumeroCreditos() ?></td>
                    <td><?= (int) $asignatura->getSemestre() ?></td>
                    <td><?= htmlspecialchars($asignatura->getProfesor(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=asignaturas.show&amp;id=<?= urlencode($asignatura->getId()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=asignaturas.edit&amp;id=<?= urlencode($asignatura->getId()) ?>">Editar</a>
                        <form method="POST" action="?route=asignaturas.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-name="<?= htmlspecialchars($asignatura->getNombre(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($asignatura->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
