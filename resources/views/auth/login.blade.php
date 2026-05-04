<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — FleetManager</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background: #f1f5f9; 
            color: #334155;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.05);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        .auth-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
        }
        .auth-header .brand-icon {
            width: 64px; height: 64px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 12px;
            padding: 0.8rem 1rem;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            background-color: #ffffff;
        }
        .btn-auth {
            background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
            color: white;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center px-4">
    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-icon">
                <i class="bi bi-truck-front-fill"></i>
            </div>
            <h3 class="fw-bold mb-0">Bon retour !</h3>
            <p class="text-white-50 mb-0 mt-1">Connectez-vous pour accéder au tableau de bord</p>
        </div>
        <div class="p-4 p-md-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                @if ($errors->any())
                    <div class="alert alert-danger" style="border-radius: 12px; font-size: 0.9rem;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted small text-uppercase">Adresse Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="exemple@entreprise.com" value="{{ old('email') }}" required autofocus style="border-radius: 0 12px 12px 0;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted small text-uppercase">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required style="border-radius: 0 12px 12px 0;">
                    </div>
                </div>

                <button type="submit" class="btn-auth mt-2">Se connecter <i class="bi bi-arrow-right ms-2"></i></button>
            </form>

            <div class="text-center mt-4 pt-2 border-top">
                <p class="text-muted small mb-0">Pas encore de compte ? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">Inscrivez-vous ici</a></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
