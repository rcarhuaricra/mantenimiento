<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Indices de Uso</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url(); ?>indices">Indices de Uso</a></li>
            <li><a href="<?php echo base_url(); ?>mantenimiento">Lotes sin CIIU</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a ><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('usuario'); ?></a></li>
            <li><a href="<?php echo base_url(); ?>home/logout"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
        </ul>
    </div>
</nav>