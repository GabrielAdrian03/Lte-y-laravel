<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tecnoservi SRL | Internet para Misiones</title>

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #007bff, #00b4d8);
            color: #fff;
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .top-right {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            animation: fadeIn 1s ease-in forwards;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
        }

        .btn-outline:hover {
            background: white;
            color: #007bff;
        }

        .btn-white {
            background: white;
            color: #007bff;
        }

        .btn-white:hover {
            background: #e3f2fd;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 100vh;
            padding: 2rem;
        }

        /* ANIMACIÓN DEL LOGO */
        .logo {
            height: 280px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            opacity: 0;
            transform: scale(0.8);
            animation: fadeZoomIn 1.2s ease-out forwards;
        }

        /* ANIMACIÓN PARA PARRAFO Y TARJETAS */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 1s ease-out forwards;
            animation-delay: 0.5s;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
            opacity: 0;
            animation: fadeUp 1s ease-out forwards;
            animation-delay: 0.8s;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            padding: 1.5rem;
            width: 260px;
            text-align: left;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .footer {
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.8);
            animation: fadeIn 1.5s ease-in forwards;
            animation-delay: 1s;
            opacity: 0;
        }

        /* ANIMACIONES DEFINIDAS */
        @keyframes fadeZoomIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    @if (Route::has('login'))
        <div class="top-right">
            @auth
                <a href="{{ url('/home') }}" class="btn btn-white">Panel</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline">Ingresar</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-white ml-2">Registrarse</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <!-- LOGO CON ANIMACIÓN -->
        <img src="{{ asset('logo_tecnoservi.png') }}" alt="Logo Tecnoservi SRL" class="logo">

        <p class="fade-in">Conectamos Misiones al futuro 🌐 — Internet rápido, estable y accesible para hogares y empresas.</p>

        <div class="card-container">
            <div class="card">
                <h3>📶 Internet de Alta Velocidad</h3>
                <p>Ofrecemos planes con fibra óptica y tecnología inalámbrica para garantizar la mejor conexión.</p>
            </div>

            <div class="card">
                <h3>👩‍💻 Soporte Personalizado</h3>
                <p>Atención cercana y asistencia técnica inmediata para resolver tus consultas sin demoras.</p>
            </div>

            <div class="card">
                <h3>🌎 Cobertura en Misiones</h3>
                <p>Ampliamos nuestra red constantemente para brindar conectividad en cada localidad de la provincia.</p>
            </div>
        </div>
    </div>

    <div class="footer">
        © 2025 Tecnoservi SRL — Todos los derechos reservados.
    </div>
</body>
</html>
