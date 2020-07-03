<!-- HEADER -->
<header class="header">
    <!-- Dropdown Navigation Menu -->
    <!-- Logo Text Romania  Feng Shui -->
    <div class="container">
        <a href="{{ route('landing-page') }}" class="navbar-brand2"><img class="logo-text" src="img/logo-text.png"
                alt="logo"></a>
        <!-- Logo Text Romania  Feng Shui -->
        <nav class="navbar navbar-expand-lg navbar-dark ">
            <!-- Logo Nod Mistic -->
            <a class="navbar-brand-logo" href="{{ route('landing-page') }}"><img src="img/logo.png" alt="logo"></a>
            <!-- Logo Nod Mistic -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown _megaMenu">
                        <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Magazin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                <!-- Search bar -->
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Cauta..." aria-label="Search">
                    <button class="btn btn-primary badge-pill my-2 my-sm-0" type="submit"><i class="fa fa-search"
                            aria-hidden="true"></i></button>
                </form>
                <!-- End -- Search bar -->
            </div>
    </div>
    </nav>
    <div class="left-line"></div>
    <div class="right-line"></div>
    </div>
</header>
<!-- Aici se incheie Headerul -->