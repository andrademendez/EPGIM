<!-- Navbar -->
<nav class="navbar bg-dark navbar-expand-lg flex-md-nowrap px-0 py-0">
    <div class="container-fluid ">
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

        <div class="collapse navbar-collapse justify-content-end ">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="material-icons">support_agent</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Stats') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Cuenta') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('perfil.edit', auth()->user()->id) }}">{{ __('Perfil')
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
