<?php
require_once './app/models/articulos.model.php';
require_once './app/views/json.view.php';

class CelularesApiController{
 
    private $model;
    private $view;

    public function __construct()
    {
        $this->model= new ArticulosModel();
        $this->view= new JSONView();

    }

    public function getAllCelulares($req, $res) {

        // VERIFICA SI LAS VARIABLES EXISTEN, EN CASO DE QUE ASI SEA SE GUARDAN EN LA REQUEST

        $orderBy = false;  // ORDENAR POR CAMPO 
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }
        $orden = false; // ORDEN ASCENDENTE O DESCENTE
        if(isset($req->query->orden)){
            $orden = $req->query->orden;
        }

        $filtro = false;  // FILTRO POR CAMPO
        if (isset($req->query->filtro)){
            $filtro = $req->query->filtro;
        }

        $valor = false; // VALOR DEL FILTRO
        if (isset($req->query->valor)) {

            $valor = $req->query->valor;
        }


        $limite=false; // LIMITE DE ELEMENTOS
        if (isset($req->query->limite)) {
            $limite = $req->query->limite;
        }

        $pagina=false;  // NUMERO DE PAGINA
        if (isset($req->query->limite)) {
            $pagina = $req->query->pagina;
        }


        $celulares = $this->model->getArticulos($orderBy,$orden,$filtro,$valor,$pagina,$limite);
        $this->view->response($celulares);
    }

    public function getCelularByID($req, $res){
        $id_articulo = $req->params->id;
        $celular = $this->model->getArticuloById($id_articulo);

        if (!$celular) {
            return $this->view->response("El celular con id = $id_articulo no existe", 404);
        }

        $this->view->response($celular);
    }

    public function deleteCelular($req, $res) {
        $id_articulo = $req->params->id;
        $celular = $this->model->getArticuloById($id_articulo);
        
        if (!$celular) {
            return $this->view->response("El celular con id = $id_articulo no existe", 404);
        }

        $this->model->deleteArticulo($id_articulo);
        $this->view->response("El celular con id=$id_articulo se elimino correctamente");

    }

    public function addCelular($req, $res) {
        if (empty($req->body->nombre) || empty($req->body->marca)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $marca = $req->body->marca;
        $memoria = $req->body->memoria;
        $pantalla = $req->body->pantalla;
        $camara = $req->body->camara;
        $precio = $req->body->precio;
        $stock = $req->body->stock;
        $img = $req->body->img;

        $id_articulo = $this->model->addArticulo($nombre, $marca, $memoria, $pantalla, $camara, $precio, $stock, $img);

        if (!$id_articulo) {
            return $this->view->response("Error al insertar el articulo", 500);
        }
         
        $celular = $this->model->getArticuloById($id_articulo);
        return $this->view->response($celular, 201);

    }

    public function editCelular($req, $res) {
        $id_articulo = $req->params->id;

        $celular = $this->model->getArticuloById($id_articulo);
        if (!$celular) {
            return $this->view->response("El celular con id = $id_articulo no existe", 404);
        }

        if (empty($req->body->nombre) || empty($req->body->marca)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $marca = $req->body->marca;
        $memoria = $req->body->memoria;
        $pantalla = $req->body->pantalla;
        $camara = $req->body->camara;
        $precio = $req->body->precio;
        $stock = $req->body->stock;
        $img = $req->body->img;

        $this->model->editArticulo($id_articulo, $nombre, $marca, $memoria, $pantalla, $camara, $precio, $stock, $img);

        $celular = $this->model->getArticuloById($id_articulo);
        $this->view->response($celular, 200);
    }




}

?>