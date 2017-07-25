<?php
$row = $descripcion->row();
?>
<div class="panel-body form-group">
    <textarea class="form-control " id="Descripcion1" name="Descripcion1" rows="4"><?php echo $row->TXTOBSERVACION; ?></textarea>
</div>
<?php
if ($row->FLGESTADO == 1) {
    ?>
    <div class="form-group panel-body">
        <button class="btn btn-success">Grabar </button>
        <button class="btn btn-info pull-right ">Guardar Descripción</button>
    </div>
    <div class="alert alert-success panel-body" role="alert">
        Deshabilitado a editar    
        <?php
        if ($this->session->userdata('codRol') == administrador) {
            ?>
            <button class="btn btn-warning pull-right" id="btnestado" type="button">Cambiar Estado</button>
            <?php
        }
        ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-danger panel-body" role="alert">
        Deshabilitado a editar    
        <?php
        if ($this->session->userdata('codRol') == administrador) {
            ?>
            <button class="btn btn-warning pull-right" id="btnestado" type="button">Cambiar Estado</button>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<script>
    $("#btnestado").click(function () {
        ordenanza = $('#cmbOrdenanza').val();
        sector = $('#cmbSector').val();
        Zonifiacion = $('#cmbZonifiacion').val();
        giro = $('#cmbGiro').val();
    });
</script>



