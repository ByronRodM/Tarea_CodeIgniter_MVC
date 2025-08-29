<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Curso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <?php echo view('partials/navbar'); ?>
    <div class="container" style="margin-top:20px;">
    <h4>Agregar Curso</h4>
    <form method="post" action="<?= site_url('cursos/store') ?>">
        <div class="input-field">
            <input type="text" id="nombre" name="nombre" required>
            <label for="nombre">Nombre</label>
        </div>
        <div class="input-field">
            <input type="text" id="profesor" name="profesor">
            <label for="profesor">Profesor</label>
        </div>
        <button class="btn waves-effect" type="submit">Guardar</button>
        <a class="btn-flat" href="<?= site_url('cursos') ?>">⬅️ Volver</a>
    </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() { M.updateTextFields(); });
    </script>
</body>
</html>
