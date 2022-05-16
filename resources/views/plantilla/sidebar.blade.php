<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>admin</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <a href="#"><i class="fa fa-gears"></i> <span>Gestionar</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('product.index') }}">productos</a></li>
                <li><a href="{{ route('sale.index') }}">compras</a></li>
                <li><a href="{{ route('sale.inventario') }}">inventario</a></li>
            </ul>

        </li>
        <li class="treeview">
            <a href="#"><i class="glyphicon glyphicon-copy"></i> <span>Repositorio</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="https://github.com/DavidSoft21">Ir a Github</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class="glyphicon glyphicon-phone"></i> <span>Contacto</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                
                <li><a href="https://www.linkedin.com/in/david-riascos-macuase-5a26b21b2/" target="_blank">Ir a Linkedin</a></li>
                <li><a href="https://api.whatsapp.com/send?phone=3024554814&text=Hola!%20David%20he%20visto%20t%C3%BA%20curr%C3%ADculum,%20nos%20gustar%C3%ADa%20citarte%20a%20una%20entrevista." target="_blank">Whatsapp</a></li>
            </ul>
        </li>
    </ul>
<!-- /.sidebar-menu -->
</section>