    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/icono_avatar.png" alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombre'] ?></p>
                <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol'] ?></p>
            </div>
        </div>
        <ul class="app-menu">
            <?php if (!empty($_SESSION['permisos'][1]['r'])) { ?> <!-- si existe en la sesion de permisos el elemento 1 y contiene r, va a mostrar todo lo que esté dentro del php -->

                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                        <i class="app-menu__icon fa-solid fa-gauge"></i>
                        <span class="app-menu__label">Dashboard</span>
                    </a>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-users"></i>
                        <span class="app-menu__label">Usuarios</span>
                        <i class="treeview-indicator fa-solid fa-arrow-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa-regular fa-circle"></i> Usuarios</a></li>
                        <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa-regular fa-circle"></i> Roles</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if ((!empty($_SESSION['permisos'][4]['r'])) || (!empty($_SESSION['permisos'][6]['r']))) { ?>
                <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview">
                        <i class="app-menu__icon fa-solid fa-shop"></i>
                        <span class="app-menu__label">Tienda</span>
                        <i class="treeview-indicator fa-solid fa-arrow-right"></i></a>
                    <ul class="treeview-menu">
                        <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/productos"><i class="icon fa-regular fa-circle"></i> Productos</a></li>
                        <?php } ?>
                        <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
                            <li><a class="treeview-item" href="<?= base_url(); ?>/categorias"><i class="icon fa-regular fa-circle"></i> Categorías</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
                <li>
                    <a class="app-menu__item" href="<?= base_url(); ?>/pedidos">
                        <i class="app-menu__icon fa-solid fa-cart-shopping"></i>
                        <span class="app-menu__label">Pedidos</span>
                    </a>
                </li>
            <?php } ?>
            <li>
                <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                    <i class="app-menu__icon fa-solid fa-right-from-bracket"></i>
                    <span class="app-menu__label">Cerrar sesión</span>
                </a>
            </li>

        </ul>
    </aside>