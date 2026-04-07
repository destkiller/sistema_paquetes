<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

$config = require __DIR__ . '/config.php';
$baseUrl = $config['base_url'];
if (isLoggedIn()) {
    $role = $_SESSION['user']['role'];
    if ($role === 'admin') redirect($baseUrl . '/admin/dashboard.php');
    if ($role === 'repartidor') redirect($baseUrl . '/repartidor/dashboard.php');
    if ($role === 'cliente') redirect($baseUrl . '/cliente/dashboard.php');
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if ($email && $password && loginUser($pdo, $email, $password)) {
        $role = $_SESSION['user']['role'];
        if ($role === 'admin') redirect($baseUrl . '/admin/dashboard.php');
        if ($role === 'repartidor') redirect($baseUrl . '/repartidor/dashboard.php');
        if ($role === 'cliente') redirect($baseUrl . '/cliente/dashboard.php');
    }
    $message = 'Credenciales inválidas. Verifica tu correo y contraseña.';
}
$title = 'Iniciar sesión';
$isLoginPage = true;
require __DIR__ . '/includes/header.php';
?>
<div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <!-- Logo/Header -->
                <div class="text-center mb-4">
                    <div class="login-logo-wrapper mb-3">
                        <i class="fas fa-box-open fa-4x" style="color: var(--ms-blue); opacity: 0.9;"></i>
                    </div>
                    <h1 class="h3 fw-bold" style="color: var(--ms-blue);">Sistema de Entregas</h1>
                    <p class="text-muted small">Panel de Control</p>
                </div>

                <!-- Card Login -->
                <div class="card login-card shadow-lg border-0" style="border-radius: 12px;">
                    <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(135deg, var(--ms-blue) 0%, var(--ms-blue-dark) 100%); border-radius: 12px 12px 0 0;">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </h4>
                    </div>
                    <div class="card-body p-5">
                        <p class="text-muted text-center mb-4">Ingresa tus credenciales para continuar</p>
                        
                        <?php if ($message): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Error:</strong> <?php echo esc($message); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="post" novalidate>
                            <div class="mb-4">
                                <label class="form-label fw-600 mb-2">
                                    <i class="fas fa-envelope me-2" style="color: var(--ms-blue);"></i>
                                    Correo Electrónico
                                </label>
                                <input type="email" 
                                       name="email" 
                                       class="form-control form-control-lg login-input" 
                                       placeholder="correo@ejemplo.com"
                                       required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-600 mb-2">
                                    <i class="fas fa-lock me-2" style="color: var(--ms-blue);"></i>
                                    Contraseña
                                </label>
                                <input type="password" 
                                       name="password" 
                                       class="form-control form-control-lg login-input" 
                                       placeholder="••••••••"
                                       required>
                            </div>

                            <button class="btn btn-primary btn-lg w-100 fw-bold py-3" 
                                    type="submit"
                                    style="background: linear-gradient(135deg, var(--ms-blue) 0%, var(--ms-blue-dark) 100%); border: none; border-radius: 8px; transition: transform 0.2s, box-shadow 0.2s;">
                                <i class="fas fa-arrow-right me-2"></i>Entrar al Sistema
                            </button>
                        </form>

                        <hr class="my-4">

                        <div class="alert alert-info alert-sm" style="border-radius: 8px; font-size: 0.85rem;">
                            <i class="fas fa-info-circle me-1"></i>
                            <strong>Demo:</strong> admin@entregas.local / Admin123
                        </div>
                    </div>
                </div>

                <!-- Footer Login -->
                <div class="text-center mt-5">
                    <p class="text-muted small">
                        <i class="fas fa-heart" style="color: var(--ms-red);"></i>
                        Desarrollado Por: <strong>Ukonex IT Holding Group</strong>
                    </p>
                    <p class="text-muted very-small" style="font-size: 0.75rem;">
                        &copy; 2026 - Todos los derechos reservados
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .login-wrapper {
        background: linear-gradient(135deg, var(--ms-gray-light) 0%, #FFFFFF 100%);
        min-height: 100vh;
    }

    .login-logo-wrapper {
        animation: fadeInDown 0.6s ease-out;
    }

    .login-card {
        animation: fadeInUp 0.6s ease-out;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 120, 212, 0.2) !important;
    }

    .login-input {
        border: 2px solid #E1DFDD;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .login-input:focus {
        border-color: var(--ms-blue);
        box-shadow: 0 0 0 0.3rem rgba(0, 120, 212, 0.1);
    }

    .fw-600 {
        font-weight: 600;
    }

    .very-small {
        font-size: 0.75rem;
        opacity: 0.7;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 120, 212, 0.3) !important;
    }

    .alert-sm {
        padding: 0.75rem 1rem;
        margin-bottom: 0;
    }

    .min-vh-100 {
        min-height: 100vh;
    }
</style>

<?php require __DIR__ . '/includes/footer.php';
