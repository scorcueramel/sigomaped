<?php
$usuario = \App\Models\User::find(Auth::id())->with('persona')->get()[0];
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="user-profile treeview">
                <a href="index.html">
                    <img src="{{ asset('assets/images/user5-128x128.jpg') }}" alt="user">
                    <span>{{ $usuario->persona->nombres }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="javascript:void()"><i class="fa fa-user mr-5"></i>Mi Perfíl </a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i
                                class="fa fa-power-off mr-5"></i>Cerrar Sesión</a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <li class="header nav-small-cap">PANEL</li>
            <li class="{{ $activePage == 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i> <span>Panel de Control</span>
                </a>
            </li>
            {{--
                <li class="header nav-small-cap">Personas</li>
                    <li class="treeview">
                    <a href="#">
                        <i class="fa fa-male" aria-hidden="true"></i>
                        <span>Personas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="pages/app/app-chat.html">
                                <i class="fa fa-circle-thin"></i>Registros
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-envelope"></i> <span>Mailbox</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/mailbox/mailbox.html"><i class="fa fa-circle-thin"></i>Inbox</a></li>
                        <li><a href="pages/mailbox/compose.html"><i class="fa fa-circle-thin"></i>Compose</a></li>
                        <li><a href="pages/mailbox/read-mail.html"><i class="fa fa-circle-thin"></i>Read</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>UI Elements</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/UI/badges.html"><i class="fa fa-circle-thin"></i>Badges</a></li>
                        <li><a href="pages/UI/border-utilities.html"><i class="fa fa-circle-thin"></i>Border</a></li>
                        <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-thin"></i>Buttons</a></li>
                        <li><a href="pages/UI/bootstrap-switch.html"><i class="fa fa-circle-thin"></i>Bootstrap Switch</a></li>
                        <li><a href="pages/UI/cards.html"><i class="fa fa-circle-thin"></i>User Card</a></li>
                        <li><a href="pages/UI/color-utilities.html"><i class="fa fa-circle-thin"></i>Color</a></li>
                        <li><a href="pages/UI/date-paginator.html"><i class="fa fa-circle-thin"></i>Date Paginator</a></li>
                        <li><a href="pages/UI/dropdown.html"><i class="fa fa-circle-thin"></i>Dropdown</a></li>
                        <li><a href="pages/UI/dropdown-grid.html"><i class="fa fa-circle-thin"></i>Dropdown Grid</a></li>
                        <li><a href="pages/UI/general.html"><i class="fa fa-circle-thin"></i>General</a></li>
                        <li><a href="pages/UI/icons.html"><i class="fa fa-circle-thin"></i>Icons</a></li>
                        <li><a href="pages/UI/media-advanced.html"><i class="fa fa-circle-thin"></i>Advanced Medias</a></li>
                        <li><a href="pages/UI/modals.html"><i class="fa fa-circle-thin"></i>Modals</a></li>
                        <li><a href="pages/UI/nestable.html"><i class="fa fa-circle-thin"></i>Nestable</a></li>
                        <li><a href="pages/UI/notification.html"><i class="fa fa-circle-thin"></i>Notification</a></li>
                        <li><a href="pages/UI/portlet-draggable.html"><i class="fa fa-circle-thin"></i>Draggable Portlets</a></li>
                        <li><a href="pages/UI/ribbons.html"><i class="fa fa-circle-thin"></i>Ribbons</a></li>
                        <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-thin"></i>Sliders</a></li>
                        <li><a href="pages/UI/sweatalert.html"><i class="fa fa-circle-thin"></i>Sweet Alert</a></li>
                        <li><a href="pages/UI/tab.html"><i class="fa fa-circle-thin"></i>Tabs</a></li>
                        <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-thin"></i>Timeline</a></li>
                        <li><a href="pages/UI/timeline-horizontal.html"><i class="fa fa-circle-thin"></i>Horizontal Timeline</a></li>
                    </ul>
                </li> --}}
            <li class="header nav-small-cap">TALLERES / INSCRIPCIONES</li>
            {{-- <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bars"></i>
                        <span>Widgets</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/widgets/blog.html"><i class="fa fa-circle-thin"></i>Blog</a></li>
                        <li><a href="pages/widgets/chart.html"><i class="fa fa-circle-thin"></i>Chart</a></li>
                        <li><a href="pages/widgets/list.html"><i class="fa fa-circle-thin"></i>List</a></li>
                        <li><a href="pages/widgets/social.html"><i class="fa fa-circle-thin"></i>Social</a></li>
                        <li><a href="pages/widgets/statistic.html"><i class="fa fa-circle-thin"></i>Statistic</a></li>
                        <li><a href="pages/widgets/weather.html"><i class="fa fa-circle-thin"></i>Weather</a></li>
                        <li><a href="pages/widgets/widgets.html"><i class="fa fa-circle-thin"></i>Widgets</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Layout Options</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-thin"></i>Boxed</a></li>
                        <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-thin"></i>Fixed</a></li>
                        <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-thin"></i>Collapsed Sidebar</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-square-o"></i>
                        <span>Box</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/box/advanced.html"><i class="fa fa-circle-thin"></i>Advanced</a></li>
                        <li><a href="pages/box/basic.html"><i class="fa fa-circle-thin"></i>Basic</a></li>
                        <li><a href="pages/box/color.html"><i class="fa fa-circle-thin"></i>Color</a></li>
                        <li><a href="pages/box/group.html"><i class="fa fa-circle-thin"></i>Group</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Charts</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-thin"></i>ChartJS</a></li>
                        <li><a href="pages/charts/flot.html"><i class="fa fa-circle-thin"></i>Flot</a></li>
                        <li><a href="pages/charts/inline.html"><i class="fa fa-circle-thin"></i>Inline charts</a></li>
                        <li><a href="pages/charts/morris.html"><i class="fa fa-circle-thin"></i>Morris</a></li>
                        <li><a href="pages/charts/peity.html"><i class="fa fa-circle-thin"></i>Peity</a></li>
                    </ul>
                </li> --}}
            <li
                class="treeview {{ $activePage == 'inscripciones.index' || $activePage == 'inscripciones.create' || $activePage == 'listaespera.index' || $activePage == 'listaespera.create' ? 'menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-pencil-square"></i> <span>Inscripciones</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'inscripciones.index' || $activePage == 'inscripciones.create' || $activePage == 'listaespera.create' || $activePage == 'listaespera.index' ? 'd-block' : '' }}"
                    id="inscripciones">
                    <li class="{{ $activePage == 'inscripciones.index' || $activePage == 'inscripciones.create' ? 'active' : '' }}"><a
                            href="{{ route('inscripciones.index') }}"><i class="fa fa-circle-thin"></i>Inscritos</a>
                    </li>
                    <li class="{{ $activePage == 'listaespera.index' || $activePage == 'listaespera.create' ? 'active' : '' }}"><a
                            href="{{ route('listaespera.index') }}"><i class="fa fa-circle-thin"></i>Lista de
                            Espera</a>
                    </li>
                </ul>
            </li>
            <li class="header nav-small-cap">GESTIÓN DE PERSONAS</li>
            <li
                class="treeview {{ $activePage == 'personas.index' || $activePage == 'personas.create' ? 'menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Personas</span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'personas.index' || $activePage == 'personas.create' ? 'd-block' : '' }}"
                    id="personas">
                    <li class="{{ $activePage == 'personas.index' || $activePage == 'personas.create' ? 'active' : '' }}"><a
                            href="{{ route('personas.index') }}"><i class="fa fa-circle-thin"></i>Registradas</a>
                    </li>
                </ul>
            </li>
            <li class="header nav-small-cap">PROGRAMAS</li>
            <li
                class="treeview {{ $activePage == 'programas.index' || $activePage == 'programas.create' ? 'menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Programas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>

            </li>
                <ul class="treeview-menu {{ $activePage == 'programas.index' || $activePage == 'programas.create' ? 'd-block' : '' }}"
                    id="programas">
                    <li class="{{ $activePage == 'programas.index' ? 'active' : '' }}"><a
                            href="{{ route('programas.index') }}"><i class="fa fa-circle-thin"></i>Listado</a>
                    </li>
                    <li class="{{ $activePage == 'programas.create' ? 'active' : '' }}"><a
                            href="{{ route('programas.create') }}"><i class="fa fa-circle-thin"></i>Nuevo Programa</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-circle-thin"></i>Simple tables</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-thin"></i>Data tables</a></li>
                    <li><a href="pages/tables/editable-tables.html"><i class="fa fa-circle-thin"></i>Editable
                            Tables</a></li>
                    <li><a href="pages/tables/table-color.html"><i class="fa fa-circle-thin"></i>Table Color</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/email/index.html">
                    <i class="fa fa-envelope-open-o"></i> <span>Emails</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
            </li>
            <li class="header nav-small-cap">EXTRA COMPONENTS</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map"></i> <span>Map</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/map/map-google.html"><i class="fa fa-circle-thin"></i>Google Map</a></li>
                    <li><a href="pages/map/map-vector.html"><i class="fa fa-circle-thin"></i>Vector Map</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-plug"></i> <span>Extension</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/extension/fullscreen.html"><i class="fa fa-circle-thin"></i>Fullscreen</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>Sample Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/samplepage/blank.html"><i class="fa fa-circle-thin"></i>Blank</a></li>
                    <li><a href="pages/samplepage/coming-soon.html"><i class="fa fa-circle-thin"></i>Coming Soon</a>
                    </li>
                    <li><a href="pages/samplepage/custom-scroll.html"><i class="fa fa-circle-thin"></i>Custom
                            Scrolls</a></li>
                    <li><a href="pages/samplepage/faq.html"><i class="fa fa-circle-thin"></i>FAQ</a></li>
                    <li><a href="pages/samplepage/gallery.html"><i class="fa fa-circle-thin"></i>Gallery</a></li>
                    <li><a href="pages/samplepage/invoice.html"><i class="fa fa-circle-thin"></i>Invoice</a></li>
                    <li><a href="pages/samplepage/lightbox.html"><i class="fa fa-circle-thin"></i>Lightbox Popup</a>
                    </li>
                    <li><a href="pages/samplepage/pace.html"><i class="fa fa-circle-thin"></i>Pace</a></li>
                    <li><a href="pages/samplepage/pricing.html"><i class="fa fa-circle-thin"></i>Pricing</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-thin"></i>Authentication
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/samplepage/login.html"><i class="fa fa-circle"></i>Login</a></li>
                            <li><a href="pages/samplepage/register.html"><i class="fa fa-circle"></i>Register</a>
                            </li>
                            <li><a href="pages/samplepage/lockscreen.html"><i
                                        class="fa fa-circle"></i>Lockscreen</a></li>
                            <li><a href="pages/samplepage/user-pass.html"><i class="fa fa-circle"></i>Recover
                                    password</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-thin"></i>Error Pages
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/samplepage/404.html"><i class="fa fa-circle"></i>404</a></li>
                            <li><a href="pages/samplepage/500.html"><i class="fa fa-circle"></i>500</a></li>
                            <li><a href="pages/samplepage/maintenance.html"><i
                                        class="fa fa-circle"></i>Maintenance</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Multilevel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Level One</a></li>
                    <li class="treeview">
                        <a href="#">Level One
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#">Level Two</a></li>
                            <li class="treeview">
                                <a href="#">Level Two
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#">Level Three</a></li>
                                    <li><a href="#">Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Level One</a></li>
                </ul>
            </li> --}}


        </ul>
    </section>
</aside>
