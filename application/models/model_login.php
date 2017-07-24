<?php

class model_login extends CI_Model {

    public function buscarOperador($usuario) {

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
        if (($row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS)) != false) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarlogin($usuario, $password) {
        //$usuario = 'RCARHUARICRAV';
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
        //
        //return oci_fetch_array($curs, OCI_ASSOC);
        $row = oci_fetch_array($curs, OCI_ASSOC + OCI_RETURN_NULLS);

        if ($password == $row['TXTPASSWORD']) {
            return true;
        } else {
            return false;
        }

        oci_free_statement($stid);
        oci_free_statement($curs);
        oci_close($conn);
    }

    public function datosUsuario($usuario, $password) {
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

        return oci_fetch_array($curs, OCI_ASSOC);
    }

}
