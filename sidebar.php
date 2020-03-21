<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <?php if (isset($_GET['menu'])) { ?>
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <?php } else { ?>
        <li class="active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <?php } ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i> <span>Input Data</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="?menu=product"><i class="fa fa-arrow-circle-right"></i> Input Product</a></li>
            <li><a href="?menu=setting"><i class="fa fa-arrow-circle-right"></i> Input Setting</a></li>
        </ul>
    </li>
    
</ul>