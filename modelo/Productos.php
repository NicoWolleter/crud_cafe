<?php
class Productos
{
    private $db;

    public function __construct()
    {
        require_once ('Conexion.php');
        $this->db = Conexion::conectar();
    }
    public function get_producto($id)
    {
        $sql = "SELECT * FROM productos WHERE id = $id";
        $query = $this->db->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_productos()
    {
        $sql = "SELECT * FROM productos";
        $query = $this->db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>