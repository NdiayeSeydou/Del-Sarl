<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page non trouvée | DEL SARL</title>

    <!-- Bootstrap 5 & Bootstrap Icons (Stack Dasher) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f5f6fa;
            color: #212529;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
        }
        .dasher-brand-icon {
            width: 42px;
            height: 42px;
            background-color: #1e293b;
            color: #ffffff;
            font-weight: 700;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
        .dasher-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            max-width: 480px;
            width: 100%;
        }
        .error-title {
            font-size: 4.5rem;
            font-weight: 800;
            letter-spacing: -2px;
            color: #0f172a;
            line-height: 1;
        }
        .btn-dark {
            background-color: #0f172a;
            border-color: #0f172a;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
        }
        .btn-dark:hover {
            background-color: #1e293b;
            border-color: #1e293b;
        }
    </style>
</head>
<body class="d-flex flex-column justify-content-between p-4">


    <!-- Contenu Central Dasher -->
    <main class="d-flex justify-content-center align-items-center my-auto py-4">
        <div class="dasher-card p-4 p-md-5 text-center shadow-sm">
            <div class="error-title mb-2">404</div>
            <h5 class="fw-bold text-dark mb-2">Page non trouvée</h5>
            <p class="text-muted small mb-4 lh-base">
                Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
            </p>

            <a href="{{ url('/') }}" class="btn btn-dark w-100 rounded-3 d-inline-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-house"></i> Retour à l'accueil
            </a>
        </div>
    </main>


</body>
</html>
