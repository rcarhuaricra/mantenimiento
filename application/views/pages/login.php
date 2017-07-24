<div class="" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="padding:10px 30px;" >
                <h4><span class="glyphicon glyphicon-lock"></span><?php echo $cabecera; ?></h4>
            </div>
            <div class="modal-body" style="padding:30px 30px;">

                <form method="post" action="<?php echo base_url(); ?>home/validar">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Ingrese Usuario" id="usuario" name="usuario" value="<?php echo set_value('usuario') ?>" required=""/>                            
                    </div>
                    <?php echo form_error('usuario'); ?>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Ingrese Password" id="password" name="password" value="<?php echo set_value('password') ?>" required=""/>
                    </div>
                    <?php echo form_error('password'); ?>
                    <button type="submit" id="login" class="btn btn-success"> Ingresar</button>
                </form>
            </div>
        </div>
    </div>
</div>

