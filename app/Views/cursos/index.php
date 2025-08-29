<!DOCTYPE html>
<html>
<head>
    <title>Lista de Cursos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

</head>
<body>
    <?php echo view('partials/navbar'); ?>
    <div class="container" style="margin-top:20px;">
    <h4><?php echo $titulo ?></h4>
    <a class="btn waves-effect" href="<?= site_url('cursos/create') ?>">➕ Nuevo Curso</a>
    <table class="striped highlight responsive-table">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Profesor</th>
            <th>Inactivo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($cursos as $row): ?>
        <tr>
            <td><?= $row['curso'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['profesor'] ?></td>
            <td><?= $row['inactivo'] ? 'Sí' : 'No' ?></td>
            <td>
                <a class="btn-small blue" href="<?= site_url('cursos/edit/' . $row['curso']) ?>">✏️ Editar</a>
                <a class="btn-small red" href="<?= site_url('cursos/delete/' . $row['curso']) ?>" onclick="return confirm('¿Seguro que quieres eliminar?')">🗑️ Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
