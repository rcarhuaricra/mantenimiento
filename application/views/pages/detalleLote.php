<form id="guardaLotes" method="post" class="panel panel-default panel-body">
    <div class="media panel-body well well-sm pegajoso">
        <div class="media-body">
            <strong class="media-heading"> Lote Nº: </strong>
            <?php echo $lote; ?>
            <br>
            <strong class="media-heading"> Zonificación: </strong>
            <?php
            foreach ($infolote->result() as $fila) {
                echo $fila->CODZONA . " ";
            }
            ?>
            <br>
            <?php
            $row = $infolote->row();
            if (isset($row)) {
                echo '<strong class="media-heading"> Sector: </strong>' . $row->CODSECTOR;
                echo "<br>";
                echo '<strong class="media-heading"> Codigo de Vía: </strong>' . $row->LOTE_CODVIA;
                echo "<br>";
                echo '<strong class="media-heading"> Nombre de Vía: </strong>' . $row->TIPO_DE_VIA . " " . $row->DENOMINACION_DE_LA_VIA;
                echo "<br>";
                echo '<strong class="media-heading"> Número de Cuadra: </strong>' . $row->LOTE_CUADRA;
                echo "<br>";
                echo '<strong class="media-heading"> Lado: </strong>' . $row->LOTE_LADO;
                echo "<br>";
                echo '<strong class="media-heading"> Esquina: </strong>' . $row->LOTE_ESQUINA;
            }
            ?>
        </div>
        <div class="media-right">
            <div class="form-group">
                <button class="btn-success btn" type="submit" id="btnguardar" ><i class="icofont icofont-save"></i> Guardar CIIU</button>
            </div>
        </div>
    </div>
    <div class="">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th class="text-center">
                        <div class="checkbox" data-toggle="tooltip" data-placement="top" 
                             title="Marcar con un Check los CIIU que tienen compatibilidad con este Lote, si no encuentra el check en la fila de un CIIU, puede activar agregando la Vía">
                            <label>
                                <input type="checkbox" id="marcarTodo" name="marcarTodo" onchange="check();">Incluir Todos<i class="icofont icofont-info-circle text-danger"></i>
                            </label>
                        </div>

                    </th>
                    <th class="text-center">Zonificación</th>
                    <th class="text-center">Sector</th>
                    <th class="text-center">Codigo CIIU</th>
                    <th class="text-center">Descripción CIIU </th>
                    <th class="text-center">Observación</th>
                    <th class="text-center" data-toggle="tooltip" data-placement="top" title="Figura un boton, cuando la vía del lote no esta vinculada con el CIIU de la fila! Puede agregar la vía dando click en el boton">Vía<i class="icofont icofont-info-circle text-danger"></i></th>
                </tr>                        
            </thead>
            <tbody>
                <?php
                foreach ($detalle->result() as $fila) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($fila->VIAINCLUIDA == '') {
                                ?>

                                <?php
                            } else {
                                ?>
                                <input type="checkbox" name="checkbox[]"  id="checkbox" value="<?php echo "$fila->CODCIIU,$fila->CODSECTOR,$fila->CODZONA,$fila->LOTE_CODVIA,$fila->LOTE_CUADRA,$fila->LOTE_CODCAT"; ?>">
                                <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $fila->CODZONA; ?></td>
                        <td><?php echo $fila->CODSECTOR; ?></td>
                        <td><?php echo $fila->CODCIIU; ?></td>
                        <td><?php echo $fila->TXTNOMBRE; ?></td>
                        <td><?php echo $fila->TXTOBSERVACION; ?></td>
                        <td>
                            <?php
                            if ($fila->VIAINCLUIDA == '') {
                                ?>
                                <button class="btn btn-danger" name="btnvia" type="button" 

                                        id="<?php echo "$fila->CODCIIU,$fila->CODSECTOR,$fila->CODZONA,$fila->LOTE_CODVIA,$fila->LOTE_CUADRA,$fila->LOTE_CODCAT"; ?>" data-toggle="tooltip" data-placement="right" title="Incluir vía en este CIIU"><i class="icofont icofont-plus"></i> </button>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        var altura = $('.pegajoso').offset().top;
        $(window).on('scroll', function () {
            if ($(window).scrollTop() > altura) {
                $('.pegajoso').addClass('menu-fixed');
            } else {
                $('.pegajoso').removeClass('menu-fixed');
            }
        });
    });
    $('button[name=btnvia]').click(function () {
        var id = this.id;
        swal({
            title: "Espere",
            text: "Confirma que desea agregar esta vía",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Confirmo!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            cache: false,
                            type: "POST",
                            url: '<?php echo base_url(); ?>mantenimiento/guardarVias',
                            data: {infor: id}, // <--- THIS IS THE CHANGE                
                            success: function (response) {
                                // <--- REFRESCO TABLA
                                lote = $('#cmblote').val();
                                $.post("<?php echo base_url(); ?>mantenimiento/detalleLotes",
                                        {cmblote: lote},
                                        function (data) {
                                            $("#detalleLote").html(data);
                                        });
                                // <--- ENVIO ALERT        
                                swal(response, "", "success");
                            },
                            error: function () {
                                alert("Operación Fallida");// <--- CARGO DATOS DEL FORMULARIO
                            }
                        });

                    } else {
                        swal("Operacion Cancelada", "La Vía no fue Agregada", "error");
                    }
                });
    });


    $('form#guardaLotes').submit(function (e) {
        e.preventDefault();
        total = $("input[name='checkbox[]']:checked").length;
        var form = $(this);
        var correcto = true;
        if (total === 0) {
            swal("Espere!", "para guardar necesita seleccionar por lo menos un CIIU", "warning");
            correcto = false;
        }
        if (correcto) {

            swal({
                title: "Se Agregaran " + total + " Registros Nuevos",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Agregar Registros!",
                cancelButtonText: "cancelar",
                closeOnConfirm: false
            },
                    function () {
                        $.ajax({
                            cache: false,
                            type: "POST",
                            url: '<?php echo base_url(); ?>mantenimiento/guardarLotes',
                            data: $('#guardaLotes').serialize(), // <--- CARGO DATOS DEL FORMULARIO
                            success: function (response) {

                                swal({
                                    title: response,
                                    text: "",
                                    type: "",
                                    showCancelButton: false,
                                    confirmButtonText: "Ok",
                                    closeOnConfirm: false
                                },
                                        function () {
                                            location.reload();
                                        });
                            },
                            error: function () {
                                alert("Error posting feed.");
                            }
                        });
                    });


        }
    });



</script>
