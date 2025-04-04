<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-5.3.1-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JS de Bootstrap et Popper.js (nécessaire pour les modals) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <title>@yield('title', 'Dashboard Technicien') - {{ Auth::user()->name }}</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="pt-3 logo ms-5">
                <a href="#"><img src="{{ asset('images/logo-ORTM.png') }}" alt="Logo"></a>
            </div>
            <div class="my-3 list-group list-group-flush">
                <a href="{{ route('technicien.dashboard') }}" class="bg-transparent list-group-item active">
                    <i class="bi bi-house-door-fill me-2"></i> Dashboard
                </a>
                <a href="{{ route('technicien.emetteurs') }}" class="bg-transparent list-group-item list-group-item-action second-text fw-bold">
                    <i class="bi bi-radioactive me-2"></i> Émetteurs en Suivi
                </a>
                @isset($intervention) <!-- Vérifier si l'intervention est définie -->
                <a href="{{ route('technicien.reparations', ['id' => $intervention->id]) }}" class="bg-transparent list-group-item list-group-item-action second-text fw-bold">
                    <i class="bi bi-tools me-2"></i> Réparations
                </a>
                @endisset
                <a href="{{ route('technicien.historiques') }}" class="bg-transparent list-group-item list-group-item-action second-text fw-bold">
                    <i class="bi bi-file-earmark-text me-2"></i> Historique des Interventions
                </a>
                <a href="#" class="bg-transparent list-group-item list-group-item-action second-text fw-bold">
                    <i class="bi bi-person-circle me-2"></i> Profil
                </a>

                <!-- Bouton de Déconnexion -->
                <button type="button" class="bg-transparent list-group-item list-group-item-action text-danger fw-bold" id="logout-button">
                    <i class="bi bi-power me-2"></i> Déconnexion
                </button>

                <!-- Formulaire de Déconnexion -->
                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Navbar Header -->
            <nav class="px-4 py-4 bg-transparent navbar navbar-expand-lg navbar-light d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="m-0 fs-2">@yield('title', 'Dashboard Technicien')</h2>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle me-2"></i>
                    <span class="fw-bold">Bonjour, {{ Auth::user()->name }}</span>
                </div>
            </nav>

            <!-- Contenu de la page -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour la déconnexion avec SweetAlert2 -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('logout-button').addEventListener('click', function() {
                Swal.fire({
                    title: 'Voulez-vous vraiment vous déconnecter ?',
                    text: "Vous serez redirigé vers la page de connexion.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, déconnexion',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
