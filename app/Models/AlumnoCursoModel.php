<?php
namespace App\Models;

use CodeIgniter\Model;

class AlumnoCursoModel extends Model
{
    protected $table = 'alumnos_cursos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'alumno',
        'curso',
        'fecha_asignacion'
    ];
}
