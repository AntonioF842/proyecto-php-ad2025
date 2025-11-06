<?php
    require_once __DIR__ . '/backend/repositories/EmpleadosRepository.php';
    require_once __DIR__ . '/backend/utils/Password.php';
    require_once __DIR__ . '/backend/utils/Token.php';

    class AuthService {
        private $repo;
        public function __construct() {
            $this->repo = new EmpleadosRepository();
        }

        public function login($usuarios, $password) {
            $empleado =$this->repo->getByUsuario($usuarios);
            if (!$empleado) {
                return [false, "Usuario no existe"];
            }
            if (!Password::verify($password, $empleado->password)) {
                return [false, "Contraseña incorrecta"];
            }
            $payload = [
                'id' => $empleado->id,
                'usuario' => $empleado->usuario,
                'rol' => $empleado->rol
            ];
            $token = Token::create($payload);
            return [true, [
                'token' => $token,
                'user' => $empleado->toPubli()
            ]];
        }
    }