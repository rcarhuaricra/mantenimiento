<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Indices extends CI_Controller {

    public function __construct() {
        parent::__construct();
// Your own constructor code

        $this->load->model('modelIndicesCIIU');
    }

    public function index() {
        if (!$this->session->userdata('login')) {
            header("Location:" . base_url() . "home");
        }
        $data['titulo'] = "Indices de Uso";
        $this->load->view('plantilla/head', $data);
        $this->load->view('plantilla/menu');
        $this->load->view("indices/filtros");
        $this->load->view('plantilla/foot');
    }

    public function comboOrdenanza() {
        if (!$this->session->userdata('login')) {
            echo FALSE;
        } else {
            echo "<option value=''>[Seleccione Ordenanza]</option>";
            $dato = $this->modelIndicesCIIU->Ordenanzas();
            foreach ($dato->result() as $fila) {
                echo "<option value='$fila->CODORDENANZA'>$fila->CODORDENANZA</option>";
            }
        }
    }

    public function comboSector() {
        if (!$this->session->userdata('login')) {
            echo FALSE;
        } else {
            $codOrdenanza = $this->input->post('cmbordenanza');
            echo "<option value=''>[Seleccione Sector]</option>";
            $dato = $this->modelIndicesCIIU->Sectores($codOrdenanza);
            foreach ($dato->result() as $fila) {
                echo "<option value='$fila->CODSECTOR'>$fila->CODSECTOR</option>";
            }
        }
    }

    public function comboZonificacion() {
        if (!$this->session->userdata('login')) {
            echo FALSE;
        } else {
            $codOrdenanza = $this->input->post('cmbordenanza');
            $codsector = $this->input->post('cmbsector');
            echo "<option value=''>[Seleccione Zonificación]</option>";
            $dato = $this->modelIndicesCIIU->zonificacion($codOrdenanza, $codsector);
            foreach ($dato->result() as $fila) {
                echo "<option value='$fila->CODZONA'>$fila->CODZONA</option>";
            }
        }
    }

    public function comboGiro() {
        if (!$this->session->userdata('login')) {
            echo FALSE;
        } else {
            echo $codOrdenanza = $this->input->post('cmbordenanza');
            echo $codsector = $this->input->post('cmbsector');
            echo $codZonificacion = $this->input->post('cmbzonifiacion');
            echo "<option value=''>[Seleccione Zonificación]</option>";
            $dato = $this->modelIndicesCIIU->giro($codOrdenanza, $codsector, $codZonificacion);
            foreach ($dato->result() as $fila) {
                echo "<option value='$fila->CODCIIU'>$fila->CODCIIU - $fila->TXTNOMBRE</option>";
            }
        }
    }

    public function descripcion() {
        if (!$this->session->userdata('login')) {
            echo FALSE;
        } else {
            $codOrdenanza = $this->input->post('cmbordenanza');
            $codsector = $this->input->post('cmbsector');
            $codZonificacion = $this->input->post('cmbzonifiacion');
            $codciiu = $this->input->post('cmbgiro');
            $dato['descripcion'] = $this->modelIndicesCIIU->descripcionModel($codOrdenanza, $codsector, $codZonificacion, $codciiu);
            $this->load->view('indices/descripcion', $dato);
        }
    }

}
