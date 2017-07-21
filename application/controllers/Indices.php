<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Indices extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->model('modelIndicesCIIU');
    }

    public function index() {
        $data['titulo'] = "Indices de Uso";
        $this->load->view('plantilla/head', $data);
        $this->load->view("indices/filtros");
    }

    public function comboOrdenanza() {
        echo "<option value=''>[Seleccione Ordenanza]</option>";
        $dato = $this->modelIndicesCIIU->Ordenanzas();
        foreach ($dato->result() as $fila) {
            echo "<option value='$fila->CODORDENANZA'>$fila->CODORDENANZA</option>";
        }
    }

    public function comboSector() {
        $codOrdenanza = $this->input->post('cmbordenanza');
        echo "<option value=''>[Seleccione Sector]</option>";
        $dato = $this->modelIndicesCIIU->Sectores($codOrdenanza);
        foreach ($dato->result() as $fila) {
            echo "<option value='$fila->CODSECTOR'>$fila->CODSECTOR</option>";
        }
    }

    public function comboZonificacion() {
        $codOrdenanza = $this->input->post('cmbordenanza');
        $codsector = $this->input->post('cmbsector');
        echo "<option value=''>[Seleccione Zonificación]</option>";
        $dato = $this->modelIndicesCIIU->zonificacion($codOrdenanza, $codsector);
        foreach ($dato->result() as $fila) {
            echo "<option value='$fila->CODZONA'>$fila->CODZONA</option>";
        }
    }

    public function comboGiro() {
        echo $codOrdenanza = $this->input->post('cmbordenanza');
        echo $codsector = $this->input->post('cmbsector');
        echo $codZonificacion = $this->input->post('cmbzonifiacion');
        echo "<option value=''>[Seleccione Zonificación]</option>";
        $dato = $this->modelIndicesCIIU->giro($codOrdenanza, $codsector, $codZonificacion);
        foreach ($dato->result() as $fila) {
            echo "<option value='$fila->CODCIIU'>$fila->CODCIIU - $fila->TXTNOMBRE</option>";
        }
    }

    public function descripcion() {
        echo $codOrdenanza = $this->input->post('cmbordenanza');
        echo $codsector = $this->input->post('cmbsector');
        echo $codZonificacion = $this->input->post('cmbzonifiacion');
        echo $codciiu = $this->input->post('cmbgiro');
        $dato = $this->modelIndicesCIIU->descripcion($codOrdenanza, $codsector, $codZonificacion, $codciiu);
        $row = $dato->row();
        if (isset($row)) {
            echo $row->title;
            echo $row->name;
            echo $row->body;
        }
    }

}
