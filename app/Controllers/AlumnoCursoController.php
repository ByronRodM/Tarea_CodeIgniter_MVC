<?php
namespace App\Controllers;

use App\Models\AlumnoCursoModel;
use App\Models\CursoModel;
use CodeIgniter\Controller;

class AlumnoCursoController extends Controller
{
    protected $alumnoCursoModel;
    protected $cursoModel;

    public function __construct()
    {
        $this->alumnoCursoModel = new AlumnoCursoModel();
        $this->cursoModel = new CursoModel();
    }

    // Devuelve JSON con cursos asignados a un alumno
    public function list($alumnoId)
    {
        $asignados = $this->alumnoCursoModel->where('alumno', $alumnoId)->findAll();
        $cursoIds = array_column($asignados, 'curso');
        if (empty($cursoIds)) {
            return $this->response->setJSON(['cursos' => [], 'ids' => []]);
        }
        $cursos = $this->cursoModel->whereIn('curso', $cursoIds)->findAll();
        return $this->response->setJSON(['cursos' => $cursos, 'ids' => $cursoIds]);
    }

    // Devuelve JSON con TODOS los cursos y los que ya están marcados
    public function allWithAssigned($alumnoId)
    {
        $todos = $this->cursoModel->findAll();
        $asignados = $this->alumnoCursoModel->where('alumno', $alumnoId)->findAll();
        $ids = array_column($asignados, 'curso');
        return $this->response->setJSON(['todos' => $todos, 'asignados' => $ids]);
    }

    // Asigna cursos (reemplaza set completo)
    public function assign($alumnoId)
    {
        $cursos = $this->request->getPost('cursos'); // array de ids
        if (!is_array($cursos)) { $cursos = []; }

        // Eliminar existentes y reinsertar (simple)
        $this->alumnoCursoModel->where('alumno', $alumnoId)->delete();
        foreach ($cursos as $cid) {
            if ($cid === '' || $cid === null) continue;
            $this->alumnoCursoModel->insert(['alumno' => $alumnoId, 'curso' => (int)$cid]);
        }
        return $this->response->setJSON(['status' => 'ok', 'count' => count($cursos)]);
    }

    // Remover un curso específico
    public function removeOne($alumnoId, $cursoId)
    {
        $this->alumnoCursoModel
            ->where('alumno', $alumnoId)
            ->where('curso', $cursoId)
            ->delete();
        return $this->response->setJSON(['status' => 'ok']);
    }
}
