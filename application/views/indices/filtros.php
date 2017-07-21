<div class="container panel-body">
    <div class="panel panel-default">    
        <div class="panel-heading">
            <strong>Registro Maestro</strong>
        </div>
        <div class="panel-body ">
            <div class="col-md-4 form-group">
                <div class="form-group input-group ">
                    <span class="input-group-addon">Tipo <span class="glyphicon glyphicon-check " aria-hidden="true"></span></span>
                    <select id="cmbOrdenanza" name="cmbOrdenanza" class="form-control space-right" required="">    
                        <option value="0">[Seleccione Tipo]</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 form-group">
                <div class="form-group input-group ">
                    <span class="input-group-addon">Sector <span class="glyphicon glyphicon-check " aria-hidden="true"></span></span>
                    <select id="cmbSector" name="cmbSector" class="form-control space-right" required="">    
                        <option value="0">[Seleccione Sector]</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 form-group">
                <div class="form-group input-group ">
                    <span class="input-group-addon">Zonificación <span class="glyphicon glyphicon-check " aria-hidden="true"></span></span>
                    <select id="cmbZonifiacion" name="cmbZonifiacion" class="form-control space-right" required="">    
                        <option value="0">[Seleccione Zonificación]</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading title">
            <strong>Registro de Vias / Cuadras / Lados</strong>
        </div>
        <form id="grabarTabla" action="" method="POST">
            <div class="panel-body">
                <div class="form-horizontal ">
                    <div class="panel panel-default panel-body ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group ">
                                    <span class="input-group-addon">Elegir Giro <span class="glyphicon glyphicon-refresh " aria-hidden="true"></span></span>
                                    <select id="cmbGiro" name="cmbGiro" class="form-control">    
                                        <option value="0">[Seleccione Giro]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div id="txtDescripcion" class="form-group panel-body">
                                </div>
                            </div>
                            <div id="chkhabilitado" class="col-md-12 ">
                            </div>
                            <div id="prueba"></div>
                            <div class="panel-body">
                                <table id="tabla1" name="" class="display table table-hover table-bordered table-container">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>indices/comboOrdenanza",
            success: function (response)
            {
                $('#cmbOrdenanza').html(response).fadeIn();
            }
        });
        $("#cmbOrdenanza").change(function () {
            $("#cmbOrdenanza option:selected").each(function () {
                ordenanza = $('#cmbOrdenanza').val();
                $.post("<?php echo base_url(); ?>indices/comboSector",
                        {cmbordenanza: ordenanza},
                        function (data) {
                            $("#cmbSector").html(data);
                            $('#cmbZonifiacion').html("<option value=''>[Seleccione Zonificación]</option>");
                            $('#cmbGiro').html("<option value=''>[Seleccione Giro]</option>");
                        });
            });
        });
        $("#cmbSector").change(function () {
            $("#cmbSector option:selected").each(function () {
                ordenanza = $('#cmbOrdenanza').val();
                sector = $('#cmbSector').val();
                $.post("<?php echo base_url(); ?>indices/comboZonificacion",
                        {cmbordenanza: ordenanza,
                         cmbsector: sector},
                        function (data) {
                            $("#cmbZonifiacion").html(data);
                            $('#cmbGiro').html("<option value=''>[Seleccione Giro]</option>");
                        });
            });
        });
        $("#cmbZonifiacion").change(function () {
            $("#cmbZonifiacion option:selected").each(function () {
                ordenanza = $('#cmbOrdenanza').val();
                sector = $('#cmbSector').val();
                Zonifiacion = $('#cmbZonifiacion').val();
                $.post("<?php echo base_url(); ?>indices/comboGiro",
                        {cmbordenanza: ordenanza,
                         cmbsector: sector,
                         cmbzonifiacion: Zonifiacion},
                        function (data) {
                            $("#cmbGiro").html(data);
                        });
            });
        });
        $("#cmbGiro").change(function () {
            $("#cmbGiro option:selected").each(function () {
                ordenanza = $('#cmbOrdenanza').val();
                sector = $('#cmbSector').val();
                Zonifiacion = $('#cmbZonifiacion').val();
                giro = $('#cmbGiro').val();
                $.post("<?php echo base_url(); ?>indices/descripcion",
                        {cmbordenanza: ordenanza,
                         cmbsector: sector,
                         cmbzonifiacion: Zonifiacion,
                         cmbgiro: giro},
                        function (data) {
                            $("#txtDescripcion").html(data);
                        });
            });
        });
    });
</script>