<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a  class="navbar-toggle collapsed" id="btnresponsive">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Indices de Uso</a>
            </a>
        </div>
        <div id="menu" class="collapse">
            <ul class="nav navbar-nav">                
                <li><a href="<?php echo base_url(); ?>mantenimiento">Lotes sin CIIU</a></li>
                <li><a href="<?php echo base_url(); ?>indices">Indices de Uso</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a ><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('usuario'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>home/logout"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
    $("#btnresponsive").click(function () {
        $("#menu").collapse('toggle');
    });
</script>