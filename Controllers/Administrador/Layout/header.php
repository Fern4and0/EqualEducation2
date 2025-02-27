<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="Administrador-Dashboard.php" style="padding: 10;">
        <img src="../../Resources/Images/logo.png" width="50" height="50" class="d-inline-block align-top" alt="Equal Education Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../../Resources/Views/index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Donaciones.php' ? 'active' : ''; ?>" href="Donaciones.php"><i class="fas fa-donate"></i> Registro de Donaciones y Gastos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Monitoreo.php' ? 'active' : ''; ?>" href="Monitoreo.php"><i class="fas fa-chart-line"></i> Monitoreo de Indicadores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Informes.php' ? 'active' : ''; ?>" href="Informes.php"><i class="fas fa-file-alt"></i> Generación de Informes</a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users-cog"></i> Gestión de Usuarios
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUsuarios">
                    <a class="dropdown-item" href="Tabla/Administradores.php">Administradores</a>
                    <a class="dropdown-item" href="Tabla/Coordinador.php">Coordinadores</a>
                    <a class="dropdown-item" href="Tabla/Beneficiarios.php">Beneficiarios</a>
                    <a class="dropdown-item" href="Tabla/Voluntarios.php">Voluntarios</a>
                    <a class="dropdown-item" href="Tabla/Donadores.php">Donadores</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../Login/Logout.php">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'es',
            includedLanguages: 'en,es',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');
    }

    function setLanguage(lang) {
        var selectField = document.querySelector("#google_translate_element select");
        for (var i = 0; i < selectField.children.length; i++) {
            var option = selectField.children[i];
            if (option.value === lang) {
                selectField.selectedIndex = i;
                selectField.dispatchEvent(new Event('change'));
                break;
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        googleTranslateElementInit();
        var userLang = navigator.language || navigator.userLanguage;
        if (userLang.startsWith('en')) {
            setLanguage('en');
        } else {
            setLanguage('es');
        }
    });
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<div id="google_translate_element" style="position: absolute; top: 10px; right: 10px;"></div>