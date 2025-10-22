<?php
require_once(__DIR__ . '/Model.php'); // Incluye la clase base Model

class UsuarioModel extends Model
{
    
     
    public function buscarPorUsuario(string $usuario): ?array
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['usuario' => $usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    
    
    public function crear(string $usuario, string $claveHash, string $rol): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        if ($stmt->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO usuarios (usuario, clave, rol) VALUES (?, ?, ?)");
        return $stmt->execute([$usuario, $claveHash, $rol]);
    }
}
