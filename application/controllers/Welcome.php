<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    /* public function index() {
      $this->load->view('welcome_message');
      }

     */

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->model('model_login');
        print_r($this->model_login->buscarOperador());
    }

    public function validar() {
        $this->form_validation->set_error_delimiters("<div class='form-group alert alert-danger'>", "</div>");
        $this->form_validation->set_rules('usuario', 'Nombre', 'required|callback_username');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $dato['titulo'] = "validacion correcta";
            $this->load->view('plantilla/head', $dato);
            $dato['cabecera'] = "Mantenimiento de Indices de Uso";
            $this->load->view('pages/login', $dato);
        } else {
            echo "correcto";
        }
    }

    public function username($user) {
        $this->load->model('model_login');
        $this->model_login->buscarOperador();
        if ($user == 'ivan') {
            return TRUE;
        } else {
            $this->form_validation->set_message('username', "El {field} $user no se encuentra registrado");
            return FALSE;
        }
    }

    public function select() {
        echo codsistema;
        echo codmodulo;
        if ($query = $this->db->query("CALL MSISEG.PKGSEG_USUARIO.PS_USUARIOLOGIN('" . codsistema . "','" . codmodulo . "','$usuario')")) {
            print_r($query->row());
        } else {
            show_error('Error!');
        }
    }

    function testProc() {
        echo $db;
        $codsistema = codsistema;
        $codmodulo = codmodulo;
        $usuario = 'RCARHUARICRAV';
        $query = "begin MSISEG.PKGSEG_USUARIO.PS_USUARIOLOGIN('" . $codsistema . "', '" . $codmodulo . "','" . $usuario . "', :data); end;";
        $stmt = OCI_Parse($conn, $query);
        echo $query . '<br>AAAAA';
        oci_bind_by_name($stmt, "data", $curs, -1, OCI_B_CURSOR);
        oci_execute($stmt);
        oci_execute($curs);
        OCIFetchInto($curs, $data, OCI_ASSOC);
        echo $curs . '<br>BBBBB';
        OCIFreeStatement($stmt);
        OCIFreeCursor($curs);
        OCILogoff($conn);
        echo $data['CODUSUARIO'] . '<br>';
        echo $data['TXTPASSWORD'] . '<br>';
        echo $data['ESTADOUSUARIO'] . '<br>';
        echo $data['CODROL'] . '<br>';
    }

}
