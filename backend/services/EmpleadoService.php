<?php
    require_once __DIR__ .'/../repositories/EmpleadosRepository.php';
    require_once __DIR__ . '/../utils/Password.php';

    class EmpleadoService {
        private $repo;
        public function __construct() {
            $this->repo = new EmpleadosRepository();
        }

        public function listAll(){
            $list = $this->repo->getAll();
            return array_map(fn($e) => $e->toPubli(), $list);
        }

        public function createEmpleado($data) {
            if (empty($data['nombre']) || empty($data['apaterno']) || empty($data['usuario']) || empty($data['password'])) {
                return [false, "Faltan datos obligatorios"];
            }

            $existing = $this->repo->getByUsuario($data['usuario']);
            if ($existing) {
                return [false, "El usuario ya existe"];
            }
            $data['password'] = Password::hash($data['password']);
            $nuevo = $this->repo->create($data);
            return [true, $nuevo->toPubli()];
        }
        public function deleteEmpleado($id) {
            $ok = $this->repo->delete($id);
            return $ok ? [true, "Empleado eliminado"] : [false, "No se encontró el empleado"];
        }

    public function updateEmpleado($id, $data) {
        if (isset($data['password']) && $data['password'] !== '') {
            $data['password'] = Password::hash($data['password']);
        } else {
            unset($data['password']);
        }

        $actualizado = $this->repo->update($id, $data);
        if (!$actualizado) {
            return [false, "No se encontró el empleado"];
        }
        return [true, $actualizado->toPubli()];
    }
    }
