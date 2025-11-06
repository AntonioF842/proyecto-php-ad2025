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
    }
