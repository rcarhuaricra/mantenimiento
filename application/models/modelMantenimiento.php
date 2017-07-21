<?php

class modelMantenimiento extends CI_Model {

    public $conexion2;

    public function lotessinCIIU() {
        $sql = "SELECT DISTINCT L.LOTE_CODCAT
                , L.CUC_LOTE
                , L.LOTE_CODUSO 
                FROM MSICAT.CODCATXZONIF C, FICHA_LOTE L WHERE  
                L.ESTADO='A' AND   (L.LOTE_CODCAT=C.CCZONIF_CODCAT)
                AND (L.LOTE_CODUSO<>'31' and L.LOTE_CODUSO<>'19' and L.LOTE_CODUSO<>'17' and L.LOTE_CODUSO<>'33' and L.LOTE_CODUSO IS NOT NULL)
                AND L.CUC_LOTE IS NOT NULL   
                AND L.LOTE_CODCAT  NOT IN (SELECT DISTINCT CL.CODLOTE FROM MSIACU.ACU_COMPATIBILIDADUSOLOTE  CL)";
        return $this->db->query($sql);
    }

    public function detalleloteModel($lote) {
        $sql = "SELECT
                (select B.CODCIIU from MSIACU.ACU_COMPATIBILIDADUSOVIA B WHERE B.CODCIIU=U.CODCIIU AND B.CODSECTOR=U.CODSECTOR AND B.CODZONA=U.CODZONA AND B.CODVIA=L.LOTE_CODVIA) as VIAINCLUIDA 
                , L.LOTE_CODCAT
                , ZON.CCZONIF_CODZON AS CODZONA
                , SUBSTR(ZON.CCZONIF_SUBSECT,1,1) AS CODSECTOR
                , U.CODCIIU
                , C.TXTNOMBRE 
                , U.TXTOBSERVACION
                , L.LOTE_CODVIA
                , RE.TIPO_DE_VIA
                , RE.DENOMINACION_DE_LA_VIA
                , L.LOTE_CUADRA                
                FROM MSICAT.FICHA_LOTE L 
                INNER JOIN MSICAT.CODCATXZONIF ZON ON L.LOTE_CODCAT=ZON.CCZONIF_CODCAT                
                INNER JOIN MSIACU.ACU_COMPATIBILIDADUSO U ON ZON.CCZONIF_CODZON=U.CODZONA AND SUBSTR(ZON.CCZONIF_SUBSECT,1,1)=U.CODSECTOR
                INNER JOIN MSIACU.ACU_COMPATIBILIDADCIIU C ON C.CODCIIU=U.CODCIIU
                INNER JOIN msirentas.relacion_de_vias RE ON RE.CODIGO_DE_VIA=L.LOTE_CODVIA
                where L.LOTE_CODCAT ='$lote' 
                order by CODCIIU asc";
        return $this->db->query($sql);
    }

    public function infolote($lote) {
        $sql = "SELECT distinct ZON.CCZONIF_CODZON AS CODZONA
                , SUBSTR(ZON.CCZONIF_SUBSECT,1,1) AS CODSECTOR
                , L.LOTE_CODVIA
                , RE.TIPO_DE_VIA
                , RE.DENOMINACION_DE_LA_VIA
                , L.LOTE_CUADRA
                , L.LOTE_ESQUINA
                , L.LOTE_LADO
                FROM MSICAT.FICHA_LOTE L
                INNER JOIN MSICAT.CODCATXZONIF ZON ON L.LOTE_CODCAT=ZON.CCZONIF_CODCAT
                INNER JOIN MSIACU.ACU_COMPATIBILIDADUSO U ON ZON.CCZONIF_CODZON=U.CODZONA AND SUBSTR(ZON.CCZONIF_SUBSECT,1,1)=U.CODSECTOR
                INNER JOIN msirentas.relacion_de_vias RE ON RE.CODIGO_DE_VIA=L.LOTE_CODVIA
                where L.LOTE_CODCAT ='$lote'";
        return $this->db->query($sql);
    }

    public function indices($lote) {
        $sql = "SELECT L.LOTE_CODCAT, ZON.CCZONIF_CODZON, SUBSTR(ZON.CCZONIF_SUBSECT,1,1)
                FROM MSICAT.FICHA_LOTE L 
                INNER JOIN MSICAT.CODCATXZONIF ZON ON L.LOTE_CODCAT=ZON.CCZONIF_CODCAT
                where L.LOTE_CODCAT ='$lote'";
        return $this->db->query($sql);
    }

    public function guardarLotesModel($insert) {
        $sql = "INSERT ALL ";
        while ($nombre_fruta = current($insert)) {
            $ke = key($insert);
            $sql.="INTO MSIACU.ACU_COMPATIBILIDADUSOLOTE (CODCIIU, CODSECTOR, CODZONA, CODVIA, CODCUADRA, CODLOTE, CODUSUARIOMOD, FECMOD) VALUES (";
            $sql.="'" . implode("','", $insert[$ke]) . "', sysdate)";
            next($insert);
        }
        $sql.="SELECT * FROM dual";
        return $this->db->query($sql);
    }

    public function guardarViaModel($insert) {
        $sql="insert INTO MSIACU.ACU_COMPATIBILIDADUSOVIA (CODCIIU, CODSECTOR, CODZONA, CODVIA, CODUSUARIOMOD, FECMOD) VALUES (";
        $sql.="'" . implode("','", $insert) . "', sysdate)";
        return $this->db->query($sql);       
    }

}
