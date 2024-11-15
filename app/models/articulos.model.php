<?php
require_once './app/models/model.php';
class ArticulosModel extends Model
{
    public function getArticulos($orderBy = false, $orden = false, $filtro, $valor, $pagina, $limite)
    {
        // SELECT DE TODOS LOS ARTICULOS
        $sql = 'SELECT * FROM articulos';

        // SI FILTRO Y VALOR ESTAN SETEADOS PREGUNTA POR EL FILTRO Y CONCATENA LA QUERY CON EL VALOR
        if ($filtro && $valor) {
            switch ($filtro) {
                case 'nombre':
                    $sql .= ' WHERE nombre LIKE "%' . $valor . '%"';
                    break;
                case 'marca':
                    $sql .= ' WHERE marca LIKE ' . intval($valor) . "";
                    break;
                case 'memoria':
                    $sql .= ' WHERE memoria LIKE ' . intval($valor) . "";
                    break;
                case 'pantalla':
                    $sql .= ' WHERE pantalla LIKE ' . intval($valor) . "";
                    break;
                case 'camara':
                    $sql .= ' WHERE camara LIKE ' . intval($valor) . "";
                    break;
                case 'precio':
                    $sql .= ' WHERE precio <= ' . intval($valor);
                    break;
                case 'stock':
                    $sql .= ' WHERE stock <= ' . intval($valor);
                    break;
            }
        }

        // SI ORDERBY ESTA SETEADO SE CONCATENA LA QUERY
        if ($orderBy) {
            switch ($orderBy) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre';
                    break;
                case 'marca':
                    $sql .= ' ORDER BY marca';
                    break;
                case 'memoria':
                    $sql .= ' ORDER BY memoria';
                    break;
                case 'pantalla':
                    $sql .= ' ORDER BY pantalla';
                    break;
                case 'camara':
                    $sql .= ' ORDER BY camara';
                    break;
                case 'precio':
                    $sql .= ' ORDER BY precio';
                    break;
                case 'stock':
                    $sql .= ' ORDER BY stock';
                    break;
            }
        }

        // SI ORDEN ESTA SETEADO SE CONCATENA A LA QUERY (Se ordena ascendentemente o descendentemente) 
        if ($orden) {
            switch ($orden) {
                case 'ASC':
                    $sql .= ' ASC';
                    break;
                case 'DESC':
                    $sql .= ' DESC';
                    break;
                case 'asc':
                    $sql .= ' ASC';
                    break;
                case 'desc':
                    $sql .= ' DESC';
                    break;
            }
        }

        // SI PAGINA Y LIMITE ESTAN SETEADOS
        if ($pagina && $limite) {
            $inicio = ($pagina - 1) * $limite; // SE SETEA EL INICIO 
            $sql .= ' LIMIT ' . intval($limite) . ' OFFSET ' . intval($inicio); // SE CONCATENA A LA QUERY EL LIMITE DE ELEMENTOS y
            // SE OMITEN DETERMINADAS FILAS CON EL OFFSET
        }

        $query = $this->db->prepare($sql);
        $query->execute();

        $articulos = $query->fetchAll(PDO::FETCH_OBJ);
        return $articulos;
    }

    public function getArticuloById($id_articulo)
    {
        $query = $this->db->prepare("SELECT * FROM articulos INNER JOIN marcas ON articulos.marca = marcas.id_marca WHERE id_articulo = ?");
        $query->execute([$id_articulo]);
        $articulo = $query->fetch(PDO::FETCH_OBJ);
        return $articulo;
    }

    public function addArticulo($nombre, $marca, $memoria, $pantalla, $camara, $precio, $stock, $img)
    {
        $query = $this->db->prepare("INSERT INTO articulos (nombre, marca, memoria, pantalla, camara, precio, stock, img) VALUES (?,?,?,?,?,?,?,?)");
        $query->execute([$nombre, $marca, $memoria, $pantalla, $camara, $precio, $stock, $img]);
        return $this->db->lastInsertId();
    }

    public function editArticulo($id_articulo, $nombre, $marca, $memoria, $pantalla, $camara, $precio, $stock, $img)
    {
        $query = $this->db->prepare("UPDATE articulos SET `nombre` = ? , `marca` = ?, `memoria` = ?, `pantalla` = ?, `camara` = ?, `precio` = ?, `stock` = ?, `img` = ? WHERE `articulos`.`id_articulo` = ?");
        $query->execute([$nombre, $marca, $memoria, $pantalla, $camara, $precio, $stock, $img, $id_articulo]);
        return $query->rowCount();
    }
    public function deleteArticulo($id_articulo)
    {
        $query = $this->db->prepare('DELETE FROM articulos WHERE id_articulo = ?');
        $query->execute([$id_articulo]);
        return $query->rowCount();
    }
}
