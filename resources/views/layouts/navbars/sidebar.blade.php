<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('images/panel.jpg') }}">
    <div class="logo ">
        <a href="" class="logo-mini">
            <img width="40" src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
            {{ __('SHOWCENTER') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ auth()->user()->profilePicture() }}" />
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
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
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
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H3a1 1 0 01-1-1V4zM8 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1H9a1 1 0 01-1-1V4zM15 3a1 1 0 00-1 1v12a1 1 0 001 1h2a1 1 0 001-1V4a1 1 0 00-1-1h-2z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="sidebar-normal"> {{ __('Espacios') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        <x-nav-li :active="request()->routeIs('tipoespacio.index')">
                            <x-nav-link :href="route('tipoespacio.index')">
                                <span class="sidebar-mini"> TE </span>
                                <span class="sidebar-normal"> {{ __('Tipo Espacio') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif
                        @if (auth()->user()->isAdmin() || auth()->user()->isValidator())
                        <x-nav-li :active="request()->routeIs('clientes.index')">
                            <x-nav-link :href="route('clientes.index')">
                                <span class="sidebar-mini">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                </span>
                                <span class="sidebar-normal"> {{ __('Clientes') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

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
                        <x-nav-li :active="request()->routeIs('campanias.index')">
                            <x-nav-link :href="route('campanias.index')">
                                <span class="sidebar-mini">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="sidebar-normal"> {{ __('Campañas') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @if (auth()->user()->isAdmin() || auth()->user()->isCreator())
                        <x-nav-li :active="request()->routeIs('campania.detalles')">
                            <x-nav-link :href="route('campania.detalles')">
                                <span class="sidebar-mini">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="sidebar-normal"> {{ __('Detalles') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif
                        @if (auth()->user()->isAdmin() || auth()->user()->isValidator())

                        <x-nav-li :active="request()->routeIs('challenge')">
                            <x-nav-link :href="route('challenge')">
                                <span class="sidebar-mini">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="sidebar-normal"> {{ __('Challenge') }} </span>
                            </x-nav-link>
                        </x-nav-li>
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
