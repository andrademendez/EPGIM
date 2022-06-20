<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('images/panel.jpg') }}">
    <div class="logo flex items-center">
        <a href="#" class="logo-mini ">
            <img class="h-6 w-9" src="{{ asset('images/logo_light.png') }}" alt="">
        </a>
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
            {{ __('G I M') }}
        </a>

    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ auth()->user()->perfil }}" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>
                        {{ auth()->user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('perfil.edit', auth()->user()->id) }}">

                                <span class="sidebar-mini">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <span class="sidebar-normal"> Mi Perfil </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="sidebar-mini">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </span>
                                <span class="sidebar-normal">Cerrar sesión</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item {{ $activePage == 'dashboard' ? ' active' : '' }}">

                <x-nav-link :href="route('dashboard')">
                    <i class="material-icons">space_dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </x-nav-link>
            </li>
            @if (auth()->user()->isAdmin())
            <li class="nav-item {{ $menuParent == 'users' ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#users" {{ ($menuParent=='Users' )
                    ? ' aria-expanded="true"' : '' }}>
                    <i class="material-icons">
                        manage_accounts
                    </i>
                    <p>{{ __('Usuarios') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $menuParent == 'users' ? ' show' : '' }}" id="users">
                    <ul class="nav">
                        @can('manage-users', App\Models\User::class)
                        <x-nav-li :active="request()->routeIs('roles.index')">
                            <a class="nav-link" href="{{ route('roles.index') }}">
                                <span class="sidebar-mini">
                                    <i class="material-icons">
                                        diversity_3
                                    </i>
                                </span>
                                <span class="sidebar-normal"> {{ __('Roles') }} </span>
                            </a>
                        </x-nav-li>
                        <x-nav-li :active="request()->routeIs('user.index')">
                            <x-nav-link :href="route('user.index')">
                                <span class="sidebar-mini">
                                    <i class="material-icons">
                                        people
                                    </i>
                                </span>
                                <span class="sidebar-normal"> {{ __('Usuarios') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        <x-nav-li :active="request()->routeIs('departamentos.index')">
                            <x-nav-link :href="route('departamentos.index')">
                                <span class="sidebar-mini">
                                    <i class="material-icons">
                                        workspaces
                                    </i>
                                </span>
                                <span class="sidebar-normal"> {{ __('Departamentos') }} </span>
                            </x-nav-link>
                        </x-nav-li>

                        @endcan
                    </ul>
                </div>
            </li>
            @endif
            @if (auth()->user()->isAdmin() || auth()->user()->isValidator())
            <!-- Administracion -->
            <li class="nav-item {{ $menuParent == 'administracion' ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#admin" {{ $menuParent=='Administracion'
                    ? 'aria-expanded="true"' : '' }}>
                    <i class="material-icons">settings</i>
                    <p> {{ __('Administración') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $menuParent == 'administracion' ? ' show' : '' }}" id="admin">
                    <ul class="nav">
                        @if (auth()->user()->isAdmin())

                        <x-nav-li :active="request()->routeIs('espacios.index')">
                            <x-nav-link :href="route('espacios.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        view_compact
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Espacios') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        <x-nav-li :active="request()->routeIs('tipoespacio.index')">
                            <x-nav-link :href="route('tipoespacio.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        view_carousel
                                    </span> </span>
                                <span class="sidebar-normal"> {{ __('Catálogos') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        <x-nav-li :active="request()->routeIs('eventos.settings')">
                            <x-nav-link :href="route('eventos.settings')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        edit_calendar
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Eventos') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif

                        @if (auth()->user()->isAdmin() || auth()->user()->isValidator())
                        <x-nav-li :active="request()->routeIs('clientes.index')">
                            <x-nav-link :href="route('clientes.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        group
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Clientes') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
            @if (auth()->user()->isAdmin() || auth()->user()->isCreator())
            <li class="nav-item {{ $menuParent == 'operacion' ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#operacion" {{ $menuParent=='Operacion'
                    ? 'aria-expanded="true"' : '' }}>
                    <i class="material-icons">insights</i>
                    <p> {{ __('Operaciones') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $menuParent == 'operacion' ? ' show' : '' }}" id="operacion">
                    <ul class="nav">
                        @if (auth()->user()->isAdmin())
                        <x-nav-li :active="request()->routeIs('catalogos.index')">
                            <x-nav-link :href="route('catalogos.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        devices_other
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Catálogos') }} </span>
                            </x-nav-link>
                        </x-nav-li>

                        @endif
                        @if (auth()->user()->isAdmin() || auth()->user()->isCreator())

                        <x-nav-li :active="request()->routeIs('contratos.index')">
                            <x-nav-link :href="route('contratos.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        description
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Contratos') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        <x-nav-li :active="request()->routeIs('cotizacion.index')">
                            <x-nav-link :href="route('cotizacion.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        request_page
                                    </span> </span>
                                <span class="sidebar-normal"> {{ __('Cotizaciones') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        <x-nav-li :active="request()->routeIs('estados.index')">
                            <x-nav-link :href="route('estados.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        bar_chart
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Estados de cuenta') }} </span>
                            </x-nav-link>
                        </x-nav-li>

                        @endif
                        <x-nav-li :active="request()->routeIs('ordenes.index')">
                            <x-nav-link :href="route('ordenes.index')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        checklist_rtl
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Ordenes de servicio') }} </span>
                            </x-nav-link>
                        </x-nav-li>


                    </ul>
                </div>
            </li>
            @endif
            @if (!auth()->user()->isAdminSO())
            <li class="nav-item {{ $menuParent == 'calendario' ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#calendario" {{ $menuParent=='calendario'
                    ? 'aria-expanded="true"' : '' }}>
                    <i class="material-icons">
                        date_range
                    </i>

                    <p> {{ __('Calendario') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse{{ $menuParent  == 'calendario' ? ' show' : '' }}" id="calendario">
                    <ul class="nav">

                        <x-nav-li :active="request()->routeIs('calendario.general')">
                            <x-nav-link :href="route('calendario.general', ['calendario' => 'general'])">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        event
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Campañas') }} </span>
                            </x-nav-link>
                        </x-nav-li>

                        @if (auth()->user()->isAdmin() || auth()->user()->isCreator())
                        <x-nav-li :active="request()->routeIs('campania.detalles')">
                            <x-nav-link :href="route('campania.detalles')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        feed
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Detalles') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif
                        @if (auth()->user()->isAdmin() || auth()->user()->isValidator())

                        <x-nav-li :active="request()->routeIs('challenge')">
                            <x-nav-link :href="route('challenge')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        event_available
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Validación') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif
                        <x-nav-li :active="request()->routeIs('campania.manager')">
                            <x-nav-link :href="route('campania.manager')">
                                <span class="sidebar-mini">
                                    <span class="material-icons">
                                        view_column
                                    </span>
                                </span>
                                <span class="sidebar-normal"> {{ __('Espacios') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                    </ul>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>
