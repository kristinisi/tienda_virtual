    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/uploads/icono_avatar.png" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">Cristina Gutierrez</p>
                <p class="app-sidebar__user-designation">Administrador</p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="<?= base_url(); ?>/dashboard.php"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon bi bi-people"></i>
                    </i><span class="app-menu__label">Usuarios</span>
                    <i class="treeview-indicator bi bi-chevron-right"></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios.php"><i class="icon bi bi-circle-fill"></i>Usuarios</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/roles.php"><i class="icon bi bi-circle-fill"></i> Roles</a></li>
                    <li><a class="treeview-item" href="<?= base_url(); ?>/permisos.php"><i class="icon bi bi-circle-fill"></i> Permisos</a></li>
                </ul>
            </li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/clientes.php"><i class="app-menu__icon bi bi-person"></i><span class="app-menu__label">Clientes</span></a></li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/productos.php"><i class="app-menu__icon bi bi-archive"></i><span class="app-menu__label">Productos</span></a></li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/pedidos.php"><i class="app-menu__icon bi bi-cart"></i><span class="app-menu__label">Pedidos</span></a></li>
            <li><a class="app-menu__item" href="<?= base_url(); ?>/logout.php"><i class="app-menu__icon bi bi-box-arrow-right"></i><span class="app-menu__label">Cerrar sesión</span></a></li>
        </ul>
    </aside>