<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>@yield('title','Gestor ADSO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            max-width: 980px;
            margin: 24px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        nav a {
            margin-right: 12px;
            color: #007bff;
            text-decoration: none;
        }

        .flash {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }
        
        /* Estilos para la paginación de Laravel */
        nav[role="navigation"] {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap; /* Permitir que los elementos se envuelvan si es necesario */
            gap: 10px;
            margin-top: 50px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        /* Ocultar el texto de "Showing..." */
        nav[role="navigation"] .hidden {
            display: none !important;
        }

        /* Estilo base para los enlaces y spans de paginación */
        nav[role="navigation"] a, 
        nav[role="navigation"] span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #007bff;
            border-radius: 4px;
            background: white;
            display: flex; /* Asegurar alineación interna */
            align-items: center;
            justify-content: center;
        }

        /* Estilo para el número de página activo */
        nav[role="navigation"] span[aria-current="page"] {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* Eliminar estilos extraños que parecen estar causando bordes dobles o cajas vacías */
        nav[role="navigation"] div,
        nav[role="navigation"] span[aria-hidden="true"] {
            border: none !important;
            background: transparent !important;
        }
    </style>
</head>

<body>
    <nav>
        <a href="/aprendices">Aprendices</a>
    </nav>
    @if(session('ok'))<div class="flash">{{ session('ok') }}</div>@endif
    @yield('content')
</body>

</html>