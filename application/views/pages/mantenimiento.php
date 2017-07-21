<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Lotes sin CIIU asignado: <?php echo count($ciiu->result()); ?></strong>
        </div>
        <div class="panel-body">
            <div class="row" >
                <div class="form-group col-md-3"> 
                    <label>Seleccione Lote: </label>
                    <select class="form-control" name="cmblote" id="cmblote" >
                        <option value="0">[Seleccione un Lote]</option>   
                        <?php
                        foreach ($ciiu->result() as $fila1) {
                            ?>
                            <option value="<?php echo $fila1->LOTE_CODCAT ?>">
                                <?php
                                echo $fila1->LOTE_CODCAT;
                                ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div id="detalleLote" name="detalleLote">

            </div>
        </div>
    </div>

</div>
<script>
    function check() {

        if (document.getElementById('marcarTodo').checked === true) {
            if ($('input[id=checkbox].disabled') == true) {
                alert('hola');
            }
            $('input[id=checkbox]').each(function () {
                this.checked = true;
            });
        } else {
            $('input[id=checkbox]').each(function () {
                this.checked = false;
            });
        }
    }
    $(document).ready(function () {
        $("#cmblote").focus();
        $("#cmblote").change(function () {
            $("#cmblote option:selected").each(function () {
                lote = $('#cmblote').val();
                if (lote === "0") {
                    $("#detalleLote").html("");
                } else {
                    $.post("<?php echo base_url(); ?>mantenimiento/detalleLotes",
                            {cmblote: lote},
                            function (data) {
                                $("#detalleLote").html(data);
                            });
                }

            });
        });


    });
</script>
