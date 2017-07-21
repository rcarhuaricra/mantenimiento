<?php

class model_login extends CI_Model {

    public function buscarOperador() {
        $usuario = 'RCARHUARICRAV';
        $codsistema = codsistema;
        $codmodulo = codmodulo;
        $conn = $this->db->conn_id;

        $curs = oci_new_cursor($conn);
        $stid = oci_parse($conn, "begin MSISEG.PKGSEG_USUARIO.PS_USUARIOLOGIN(:codsistema,:codmodulo,:usuario,:data); end;");
        oci_bind_by_name($stid, ':codsistema', $codsistema);
        oci_bind_by_name($stid, ':codmodulo', $codmodulo);
        oci_bind_by_name($stid, ':usuario', $usuario);
        oci_bind_by_name($stid, ":data", $curs, -1, OCI_B_CURSOR);
        oci_execute($stid);
        oci_execute($curs);  // Ejecutar el REF CURSOR como un ide de sentencia normal
        return oci_fetch_array($curs, OCI_ASSOC );        
        oci_free_statement($stid);
        oci_free_statement($curs);
        oci_close($conn);
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
        if ($query = $this->db->query("CALL MSISEG.PKGSEG_USUARIO.PS_USUARIOLOGIN('" . codsistema . "','" . codmodulo . "','$usuario')")) {
            print_r($query->row());
        } else {
            show_error('Error!');
        }
    }

}
