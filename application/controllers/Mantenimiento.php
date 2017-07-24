<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mantenimiento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // cargo el modelo para todas las funciones en este controlador
        $this->load->model('modelMantenimiento');
    }

    public function index() {
        $data['titulo'] = "Mantenimiento de Indices de Uso";
        $this->load->view('plantilla/head', $data);
        $this->load->view('plantilla/menu');
        $dato['ciiu'] = $this->modelMantenimiento->lotessinCIIU();
        $this->load->view('pages/mantenimiento', $dato);
        $this->load->view('plantilla/foot', $data);
    }

    public function detalleLotes() {
        $dato['lote'] = $this->input->post('cmblote');
        $dato['infolote'] = $this->modelMantenimiento->infolote($this->input->post('cmblote'));
        $dato['detalle'] = $this->modelMantenimiento->detalleloteModel($this->input->post('cmblote'));
        $this->load->view('pages/detallelote', $dato);
    }

    public function guardarLotes() {
        $datos = $this->input->post('checkbox[]');
        if ($datos == '') {
            echo "elija alguna opcion";
        } else {
            $i = 0;
            $insert = array();
            while ($i < count($datos)) {
                $data = explode(",", $datos[$i]);
                $a = array('CODCIIU' => $data[0],
                    'CODSECTOR' => $data[1],
                    'CODZONA' => $data[2],
                    'CODVIA' => $data[3],
                    'CODCUADRA' => $data[4],
                    'CODLOTE' => $data[5],
                    'CODUSUARIOMOD' => 'ppp');
                array_push($insert, $a);
                $i++;
            }
            if ($this->modelMantenimiento->guardarLotesModel($insert) == 1) {
                echo "Datos Ingresados Correctamente";
            } else {
                echo "ocurrio un error al guardar los datos";
            }
        }
    }

    public function guardarVias() {
        $data = explode(",", $this->input->post('infor'));
        $reemplazo = array(4 => "ppp");
        $insert = array_replace($data, $reemplazo);
        unset($insert[5]);
        //echo $this->modelMantenimiento->guardarViaModel($insert);
        if ($this->modelMantenimiento->guardarViaModel($insert) == 1) {
            echo "Datos Ingresados Correctamente";
        } else {
            echo "ocurrio un error al guardar los datos";
        }
    }

}
