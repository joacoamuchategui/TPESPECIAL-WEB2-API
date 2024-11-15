<?php
require_once './app/models/model.php';

Class MarcasModel extends Model {
    public function getMarcas($orderBy,$orden)
    {
        // SELECT DE TODAS LAS MARCAS
        $sql='SELECT * from marcas';

        // SI ORDERBY ESTA SETEADO SE CONCATENA LA QUERY
        if($orderBy) {
            switch($orderBy) {
                case 'marca':
                    $sql .= ' ORDER BY id_marca';
                    break;
                case 'nombre':
                    $sql .= ' ORDER BY nombre';
                    break;
            }
        }

        // SI ORDEN ESTA SETEADO SE CONCATENA A LA QUERY (Se ordena ascendentemente o descendentemente) 
        if($orden){
            switch($orden) {
                case 'asc':
                    $sql .= ' ASC';
                    break;
                case 'desc':
                    $sql .= ' DESC';
                    break;
                case 'ASC':
                    $sql .= ' ASC';
                    break;
                case 'DESC':
                    $sql .= ' DESC';
                    break;
            }
        }


        $query = $this->db->prepare($sql);
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }

    public function getMarcaById($id_marca)
    {
        $query = $this->db->prepare('SELECT * FROM marcas WHERE id_marca = ?');
        $query->execute([$id_marca]);
        $marca = $query->fetch(PDO::FETCH_OBJ);
        return $marca;
    }
    public function addMarca($nombre, $img_marca)
    {
        $query = $this->db->prepare("INSERT INTO marcas (nombre_marca, img_marca) VALUES (?, ?)");
        $query->execute([$nombre, $img_marca]);
        return $this->db->lastInsertId();
    }

    public function editMarca($id_marca, $nombre, $img)
    {
        $query = $this->db->prepare("UPDATE `marcas` SET `nombre_marca` = ?, `img_marca`= ?  WHERE `marcas`.`id_marca` = ?");
        $query->execute([$nombre, $img, $id_marca]);
        return $query->rowCount();
    }
    public function deleteMarca($id_marca)
    {
        $query1 = $this->db->prepare('DELETE articulos.* FROM articulos INNER JOIN marcas ON marcas.id_marca = articulos.marca WHERE marcas.id_marca = ?');
        $query2 = $this->db->prepare('DELETE FROM marcas WHERE id_marca = ?');
        $query1->execute([$id_marca]);
        $query2->execute([$id_marca]);
        return $query2->rowCount();
    }
}