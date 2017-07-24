<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    /* public function index() {
      $this->load->view('welcome_message');
      }

     */

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->model('model_login');
        $this->load->library('form_validation');
        if ($this->session->userdata('login')) {
            header("Location:" . base_url() . "mantenimiento");
        }
    }

    public function index() {
        header("Location:" . base_url() . "home/validar");
    }

    public function validar() {
        $this->form_validation->set_error_delimiters("<div class='form-group alert alert-danger'>", "</div>");
        $this->form_validation->set_rules('usuario', 'Nombre', 'required|callback_username');
        $this->form_validation->set_rules('password', 'Password', "required|callback_validaPassword");
        if ($this->form_validation->run() == FALSE) {
            $dato['titulo'] = "validacion correcta";
            $this->load->view('plantilla/head', $dato);
            $dato['cabecera'] = "Mantenimiento de Indices de Uso";
            $this->load->view('pages/login', $dato);
        } else {
            $usuario = strtoupper($this->input->post('usuario'));
            $password = md5(strtoupper($this->input->post('password')));

            $login = $this->model_login->datosUsuario($usuario, $password);
            $data = array(
                'usuario' => $login['CODUSUARIO'],
                'estadoUsuario' => $login['ESTADOUSUARIO'],
                'codRol' => $login['CODROL'],
                'login' => TRUE
            );
            $this->session->set_userdata($data);
            header("Location:" . base_url() . "mantenimiento");
        }
    }

    public function username() {
        $usuario = strtoupper($this->input->post('usuario'));
        $this->load->model('model_login');
        if ($this->model_login->buscarOperador($usuario) == false) {
            $this->form_validation->set_message('username', "El {field} $usuario no se encuentra registrado");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function validaPassword() {
        $usuario = strtoupper($this->input->post('usuario'));
        $password = md5(strtoupper($this->input->post('password')));
        $this->load->model('model_login');
        $this->model_login->verificarlogin($usuario, $password);
        if ($this->model_login->verificarlogin($usuario, $password) == TRUE) {
            return true;
        } else {
            $this->form_validation->set_message('validaPassword', "El {field} es incorrecto");
            return FALSE;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        header("location:" . base_url());
    }

}
