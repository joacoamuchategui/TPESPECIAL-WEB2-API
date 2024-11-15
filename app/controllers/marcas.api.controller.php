<?php
require_once './app/models/marcas.model.php';
require_once './app/views/json.view.php';

class MarcasApiController{

    private $model;
    private $view;
    public function __construct()
    {
        $this->model = new MarcasModel();
        $this->view = new JSONView();  
    }
    public function getAllMarcas($req, $res){

        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $orden = false;
        if(isset($req->query->orden))
            $orden = $req->query->orden;

        $marcas = $this->model->getMarcas($orderBy, $orden);
        $this->view->response($marcas);
    }
    public function getMarcaByID($req, $res) {
        $id_marca = $req->params->id;
        $marca = $this->model->getMarcaById($id_marca);
        $this->view->response($marca);
    }

    public function deleteMarca($req, $res){
        $id_marca = $req->params->id;
        $marca = $this->model->getMarcaById($id_marca);

        if (!$marca) {
            return $this->view->response("La marca con id=$id_marca no existe", 404);
        }

        $this->model->deleteMarca($id_marca);
        $this->view->response("La marca con id=$id_marca se elimino correctamente");
    }

    public function addMarca($req, $res) {
        if (empty($req->body->nombre)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $img_marca = $req->body->img_marca;

        $id_marca = $this->model->addMarca($nombre, $img_marca);

        if (!$id_marca) {
            return $this->view->response("Error al insertar la marca", 500);
        }

        $marca = $this->model->getMarcaById($id_marca);
        return $this->view->response($marca, 201);
    }

    public function editMarca($req, $res) {
        $id_marca = $req->params->id;

        $marca = $this->model->getMarcaById($id_marca);
        if (!$marca) {
            return $this->view->response("La marca con id=$id_marca no existe", 404);
        }

        if (empty($req->body->nombre)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $nombre = $req->body->nombre;
        $img_marca = $req->body->img_marca;

        $this->model->editMarca($id_marca, $nombre, $img_marca);

        $marca = $this->model->getMarcaById($id_marca);
        $this->view->response($marca, 200);
    }


}