<?php

class model_login extends CI_Model {

    public function buscarOperador($usuario) {
        $params = array(
            array('name' => ':params1', 'value' => codsistema, 'type' => SQLT_CHR, 'length' => 32),
            array('name' => ':params2', 'value' => codmodulo, 'type' => SQLT_CHR, 'length' => 32),
            array('name' => ':params3', 'value' => $usuario, 'type' => SQLT_CHR, 'length' => 32),
            array('name' => ':data', 'value' => 'data', 'type' => SQLT_CHR, 'length' => 32)
        );
        $this->db->stored_procedure('MSISEG.PKGSEG_USUARIO', 'PS_USUARIOLOGIN', $params);
//        $stmt = oci_parse($this->db->conn_id, "begin MSISEG.PKGSEG_USUARIO.PS_USUARIOLOGIN(:params1, :params2',':params3', :data); end;");
//        //$stmt = oci_parse($this->db->conn_id, "begin package.procedure_name(:params1, :params2, :params3); end;");
//
//        foreach ($params as $p)
//            oci_bind_by_name($stmt, $p['name'], $p['value'], $p['length']);
//        $r = ociexecute($stmt);
    }

    public function buscarOperador2() {
        $rsponse = '';
        $s = oci_parse($this->db->conn_id, "begin packageName.procedureName(:bind1,:bind2,:bind3,:bind4,:bind5); end;");
        oci_bind_by_name($s, ":bind1", $data['fieldOne'], 300);
        oci_bind_by_name($s, ":bind2", $data['fieldTwo'], 300);
        oci_bind_by_name($s, ":bind3", $data['fieldThre'], 300);
        oci_bind_by_name($s, ":bind4", $data['fieldFour'], 300);
        oci_bind_by_name($s, ":bind4", $response, 300);
        oci_execute($s, OCI_DEFAULT);
        echo $message;
    }

    public function select_user() {
        if ($query = $this->db->query("CALL MSISEG.PKGSEG_USUARIO.PS_USUARIOLOGIN('".codsistema."','".codmodulo."','$usuario')")) {
            print_r($query->row());
        } else {
            show_error('Error!');
        }
    }

}
