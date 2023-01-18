<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!--
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                -->
                @auth()
                   @if(auth()->user()->tipo === 'ADMIN')
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Usuario.index') }}">
                                Usuarios
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Proveedor.index') }}">
                                Proveedores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Articulo.index') }}">
                                Articulos
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->tipo === 'USR')
                           <li class="nav-item">
                               <a class="nav-link active" aria-current="page" href="{{ route('Venta.index') }}">
                                   Comprar
                               </a>
                           </li>
                       @endif
                @endauth

            </ul>

            @guest()
                <div class="text-end">
                    <a class="btn btn-primary" href="{{ route('login.show') }}">Logearse</a>
                </div>
            @endguest

            @auth()
                <div class="text-end">
                    <a class="btn btn-primary" href="{{ route('logout.perfom') }}">Cerrar Sesión</a>
                </div>
            @endauth

        </div>
    </div>
</nav>
