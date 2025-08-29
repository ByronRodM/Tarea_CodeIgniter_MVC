<!DOCTYPE html>
<html>
<head>
    <title>Lista de Alumnos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <?php echo view('partials/navbar'); ?>
    <div class="container" style="margin-top:20px;">
    <h4>Alumnos</h4>
    <a class="btn waves-effect" href="<?= site_url('alumnos/create') ?>">➕ Nuevo Alumno</a>
        <table class="striped highlight responsive-table">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Móvil</th>
            <th>Email</th>
                        <th>Ver Cursos</th>
                        <th>Asignar Cursos</th>
            <th>Inactivo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($alumnos as $alumno): ?>
        <tr>
            <td><?= $alumno['alumno'] ?></td>
            <td><?= $alumno['nombre'] ?></td>
            <td><?= $alumno['apellido'] ?></td>
            <td><?= $alumno['direccion'] ?></td>
            <td><?= $alumno['movil'] ?></td>
            <td><?= $alumno['email'] ?></td>
                        <td>
                                <a href="#!" class="ver-cursos" data-alumno="<?= $alumno['alumno'] ?>" title="Ver cursos asignados">
                                    <i class="material-icons <?= $alumno['cursos_count']>0 ? 'teal-text' : 'grey-text' ?>" id="icon-ver-<?= $alumno['alumno'] ?>">list</i>
                                </a>
                        </td>
                        <td>
                                <a href="#!" class="asignar-cursos" data-alumno="<?= $alumno['alumno'] ?>" title="Asignar cursos">
                                    <i class="material-icons <?= $alumno['cursos_count']>0 ? 'amber-text' : 'grey-text' ?>" id="icon-asignar-<?= $alumno['alumno'] ?>">note_add</i>
                                </a>
                        </td>
            <td><?= $alumno['inactivo'] ? 'Sí' : 'No' ?></td>
            <td>
                <a class="btn-small blue" href="<?= site_url('alumnos/edit/' . $alumno['alumno']) ?>">✏️ Editar</a>
                <a class="btn-small red" href="<?= site_url('alumnos/delete/' . $alumno['alumno']) ?>" onclick="return confirm('¿Seguro que quieres eliminar?')">🗑️ Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
        <!-- Modal Ver Cursos -->
        <div id="modalVerCursos" class="modal">
            <div class="modal-content">
                <h5>Cursos Asignados</h5>
                <ul id="listaCursosAsignados" class="collection"></ul>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect btn-flat">Cerrar</a>
            </div>
        </div>

        <!-- Modal Asignar Cursos -->
        <div id="modalAsignarCursos" class="modal">
            <div class="modal-content">
                <h5>Asignar Cursos</h5>
                <form id="formAsignarCursos">
                    <div id="checkboxCursos" class="row" style="max-height:300px; overflow:auto;"></div>
                    <input type="hidden" id="alumnoIdAsignar" name="alumnoId" />
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect btn-flat">Cancelar</a>
                <button id="btnGuardarAsignacion" class="waves-effect waves-light btn">Guardar</button>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modals = document.querySelectorAll('.modal');
                M.Modal.init(modals);

                // Click ver cursos
                document.querySelectorAll('.ver-cursos').forEach(function(el){
                    el.addEventListener('click', function(){
                        const alumnoId = this.dataset.alumno;
                        fetch(`${window.location.origin}/alumnos/${alumnoId}/cursos`)
                            .then(r=>r.json())
                            .then(data=>{
                                 const ul = document.getElementById('listaCursosAsignados');
                                 ul.innerHTML='';
                                 if(data.cursos.length===0){
                                     ul.innerHTML = '<li class="collection-item">Sin cursos asignados</li>';
                                 } else {
                                     data.cursos.forEach(c=>{
                                         const li = document.createElement('li');
                                         li.className='collection-item';
                                         li.textContent = c.nombre + ' (' + (c.profesor||'--') + ')';
                                         ul.appendChild(li);
                                     });
                                 }
                                 M.Modal.getInstance(document.getElementById('modalVerCursos')).open();
                            });
                    });
                });

                // Click asignar cursos
                document.querySelectorAll('.asignar-cursos').forEach(function(el){
                    el.addEventListener('click', function(){
                        const alumnoId = this.dataset.alumno;
                        document.getElementById('alumnoIdAsignar').value = alumnoId;
                        fetch(`${window.location.origin}/alumnos/${alumnoId}/cursos/all`)
                            .then(r=>r.json())
                            .then(data=>{
                                const cont = document.getElementById('checkboxCursos');
                                cont.innerHTML='';
                                data.todos.forEach(c=>{
                                    const checked = data.asignados.includes(c.curso) ? 'checked' : '';
                                    const div = document.createElement('div');
                                    div.className='col s12';
                                    div.innerHTML = `<label><input type="checkbox" class="filled-in" name="cursos[]" value="${c.curso}" ${checked}><span>${c.nombre}</span></label>`;
                                    cont.appendChild(div);
                                });
                                M.Modal.getInstance(document.getElementById('modalAsignarCursos')).open();
                            });
                    });
                });

                document.getElementById('btnGuardarAsignacion').addEventListener('click', function(){
                    const alumnoId = document.getElementById('alumnoIdAsignar').value;
                    const form = document.getElementById('formAsignarCursos');
                    const formData = new FormData(form);
                    fetch(`${window.location.origin}/alumnos/${alumnoId}/cursos/asignar`, {
                        method: 'POST',
                        body: formData
                    }).then(r=>r.json()).then(data=>{
                        // actualizar colores iconos
                        const has = data.count > 0;
                        const iconVer = document.getElementById('icon-ver-' + alumnoId);
                        const iconAsignar = document.getElementById('icon-asignar-' + alumnoId);
                        if(has){
                            iconVer.classList.remove('grey-text'); iconVer.classList.add('teal-text');
                            iconAsignar.classList.remove('grey-text'); iconAsignar.classList.add('amber-text');
                        } else {
                            iconVer.classList.add('grey-text'); iconVer.classList.remove('teal-text');
                            iconAsignar.classList.add('grey-text'); iconAsignar.classList.remove('amber-text');
                        }
                        M.toast({html: 'Asignaciones guardadas'});
                        M.Modal.getInstance(document.getElementById('modalAsignarCursos')).close();
                    });
                });
            });
        </script>
</body>
</html>
