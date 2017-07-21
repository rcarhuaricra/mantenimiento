<?php

class modelIndicesCIIU extends CI_Model {

    public function Ordenanzas() {
        $sql = "SELECT DISTINCT CODORDENANZA FROM MSIACU.ACU_COMPATIBILIDADUSO ORDER BY CODORDENANZA asc";
        return $this->db->query($sql);
    }

    public function Sectores($codOrdenanza) {
        $sql = "SELECT DISTINCT CODSECTOR FROM MSIACU.ACU_COMPATIBILIDADUSO where CODORDENANZA='$codOrdenanza' ORDER BY CODSECTOR asc";
        return $this->db->query($sql);
    }

    public function zonificacion($codOrdenanza, $codsector) {
        $sql = "SELECT DISTINCT CODZONA FROM MSIACU.ACU_COMPATIBILIDADUSO where CODORDENANZA='$codOrdenanza' and CODSECTOR='$codsector' ORDER BY CODZONA asc";
        return $this->db->query($sql);
    }

    public function giro($codOrdenanza, $codsector, $codZonificacion) {
        $sql = "SELECT B.CODCIIU, A.TXTNOMBRE
                FROM MSIACU.ACU_COMPATIBILIDADCIIU A
                INNER JOIN MSIACU.ACU_COMPATIBILIDADUSO B ON B.CODCIIU=A.CODCIIU
                WHERE CODORDENANZA='$codOrdenanza' AND B.CODSECTOR='$codsector'  AND B.CODZONA='$codZonificacion'
                ORDER BY B.CODCIIU ASC";
        return $this->db->query($sql);
    }

    public function descripcion($codOrdenanza, $codsector, $codZonificacion, $codciiu) {
        $sql = "select * from MSIACU.ACU_COMPATIBILIDADUSO 
                WHERE CODORDENANZA = '$codOrdenanza' 
                AND CODSECTOR = '$codsector' 
                AND CODZONA = '$codZonificacion' 
                AND CODCIIU = '$codciiu'";
        return $this->db->query($sql);
    }

}
