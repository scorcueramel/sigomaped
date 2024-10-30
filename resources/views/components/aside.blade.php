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
            <li class="header nav-small-cap">INSCRIPCIONES</li>
            <li
                class="treeview {{ $activePage == 'inscripciones.index' || $activePage == 'inscripciones.calendar' || $activePage == 'inscripciones.create' || $activePage == 'listaespera.index' || $activePage == 'listaespera.create' ? 'menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-pencil-square"></i> <span>Inscripciones</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'inscripciones.index' || $activePage == 'inscripciones.calendar' || $activePage == 'inscripciones.create' || $activePage == 'listaespera.create' || $activePage == 'listaespera.index' ? 'd-block' : '' }}"
                    id="inscripciones">
                    <li class="{{ $activePage == 'inscripciones.index' || $activePage == 'inscripciones.create' ? 'active' : '' }}"><a
                            href="{{ route('inscripciones.index') }}"><i class="fa fa-circle-thin"></i>Inscritos</a>
                    </li>
                    <li class="{{ $activePage == 'inscripciones.calendar' ? 'active' : '' }}"><a
                            href="{{ route('inscripciones.calendar') }}"><i class="fa fa-circle-thin"></i>Calendario</a>
                    </li>
                    <li class="{{ $activePage == 'listaespera.index' || $activePage == 'listaespera.create' ? 'active' : '' }}"><a
                            href="{{ route('listaespera.index') }}"><i class="fa fa-circle-thin"></i>Lista de
                            Espera</a>
                    </li>
                </ul>
            </li>
            <li class="header nav-small-cap">ASISTENCIA</li>
            <li
                class="treeview {{ $activePage == 'asistencia.index' ? 'menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> <span>Inasistencias</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'asistencia.index' ? 'd-block' : '' }}"
                    id="inscripciones">
                    <li class="{{ $activePage == 'asistencia.index' ? 'active' : '' }}"><a
                            href="{{ route('asistencia.index') }}"><i class="fa fa-circle-thin"></i>Registros</a>
                    </li>
                </ul>
            </li>
            <li class="header nav-small-cap">CONFIGURACIÓN</li>
            <li
                class="treeview {{ $activePage == 'personas.index' || $activePage == 'personas.create' ? 'menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Personas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'personas.index' || $activePage == 'personas.create' ? 'd-block' : '' }}"
                    id="personas">
                    <li class="{{ $activePage == 'personas.index' || $activePage == 'personas.create' ? 'active' : '' }}"><a
                            href="{{ route('personas.index') }}"><i class="fa fa-circle-thin"></i>Registradas</a>
                    </li>
                </ul>
            </li>
            <li
                class="treeview {{ $activePage == 'programas.index' || $activePage == 'programas.create' ? 'menu-open' : '' }}">
                <a href="#" onclick="">
                    <i class="fa fa-list"></i> <span>Programas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'programas.index' || $activePage == 'programas.create' ? 'd-block' : '' }}"
                    id="programas">
                    <li class="{{ $activePage == 'programas.index' ? 'active' : '' }}"><a
                            href="{{ route('programas.index') }}"><i class="fa fa-circle-thin"></i>Listado</a>
                    </li>
                </ul>
            </li>
            <li
                class="treeview {{ $activePage == 'talleres.index' || $activePage == 'talleres.create' ? 'menu-open' : '' }}">
                <a href="#" onclick="">
                    <i class="fa fa-list"></i> <span>Talleres</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'talleres.index' || $activePage == 'talleres.create' ? 'd-block' : '' }}"
                    id="talleres">
                    <li class="{{ $activePage == 'talleres.index' ? 'active' : '' }}"><a
                            href="{{ route('talleres.index') }}"><i class="fa fa-circle-thin"></i>Listado</a>
                    </li>
                </ul>
            </li>
            <li
                class="treeview {{ $activePage == 'anioperiodo.index' || $activePage == 'anioperiodo.create' ? 'menu-open' : '' }}">
                <a href="#" onclick="">
                    <i class="fa fa-calendar-plus-o"></i> <span>Año Periodo</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu {{ $activePage == 'anioperiodo.index' || $activePage == 'anioperiodo.create' ? 'd-block' : '' }}"
                    id="anioperiodo">
                    <li class="{{ $activePage == 'anioperiodo.index' ? 'active' : '' }}"><a
                            href="{{ route('anioperiodo.index') }}"><i class="fa fa-circle-thin"></i>Listado</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
