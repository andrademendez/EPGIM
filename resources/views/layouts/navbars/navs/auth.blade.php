<!-- Navbar -->
<nav class="navbar bg-dark navbar-expand-lg flex-md-nowrap px-0 py-0">
    <div class="container-fluid flex items-center justify-between ">
        <div class="navbar-wrapper ">
            <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
            </div>
            <a class="navbar-brand" href="">{{ $titlePage }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="flex justify-end py-2">
            @if (request()->routeIs('calendario.general'))
            <div class="flex items-center justify-end space-x-3">
                <div class="whitespace-nowrap uppercase text-xs font-bold">
                    <a href="{{ route('calendario.general', ['calendario' => 'general']) }}"
                        class="px-3 py-2 border-b-2 border-indigo-700 text-white rounded-lg hover:bg-gray-700">General</a>
                </div>
                <div class="whitespace-nowrap uppercase text-xs font-bold">
                    <a href="{{ route('calendario.general', ['calendario' => 'airo']) }}"
                        class="px-3 py-2 border-b-2 border-indigo-700 text-white rounded-lg hover:bg-gray-700"">Airó</a>
                </div>
                <div class=" whitespace-nowrap uppercase text-xs font-bold">
                        <a href="{{ route('calendario.general', ['calendario' => 'fashion']) }}"
                            class="px-3 py-2 border-b-2 border-indigo-700 text-white rounded-lg hover:bg-gray-700"" href="
                            #">Fashion
                            Drive</a>
                </div>
                <div class="whitespace-nowrap uppercase text-xs font-bold">
                    <a href="{{ route('calendario.general', ['calendario' => 'main']) }}"
                        class="px-3 py-2 border-b-2 border-indigo-700 text-white rounded-lg hover:bg-gray-700"" href="
                        #">Main
                        Entrance</a>
                </div>
                <div class="whitespace-nowrap uppercase text-xs font-bold">
                    <a href="{{ route('calendario.general', ['calendario' => 'showcenter']) }}"
                        class="px-3 py-2 border-b-2 border-indigo-700 text-white rounded-lg hover:bg-gray-700"">Showcenter</a>
                </div>

            </div>

            @endif
        </div>
        <div class=" collapse navbar-collapse justify-content-end w-full">
                        <ul class="navbar-nav">
                            <li>
                                <a href="">
                                    <span class="material-icons">
                                        notifications
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">person</i>
                                    <p class="d-lg-none d-md-block">
                                        {{ __('Cuenta') }}
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="{{ route('perfil.edit', auth()->user()->id) }}">{{
                                        __('Perfil')
                                        }}</a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-item">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-nav-items :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                {{ __('Cerrar sesión') }}
                                            </x-nav-items>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
</nav>
<!-- End Navbar -->
