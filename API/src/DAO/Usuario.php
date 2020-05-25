<?php

namespace App\DAO;

use Source\DAO\Conexao;

class Usuario extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByUsuario(string $usuario): ?UsuarioModel
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    id,
                    usuario,                    
                    senha
                FROM usuarios
                WHERE usuario = :usuario;
            ');
        $statement->bindParam('email', $usuario);
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($usuarios) === 0)
            return null;
        $usuario = new UsuarioModel();
        $usuario->setId($usuarios[0]['id'])
            ->setNome($usuarios[0]['nome'])
            ->setUsuario($usuarios[0]['usuario'])
            ->setSenha($usuarios[0]['senha']);
        return $usuario;
    }
}