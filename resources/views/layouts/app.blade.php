<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('title', 'Gestor ADSO')</title>

    <style>
        :root {
            --primary-color: #2980b9;
            --text-color: #2c3e50;
            --bg-color: #ecf0f1;
            --border-color: #bdc3c7;
            --success-bg: #d6eaf8;
            --success-border: #aed6f1;
            --danger-bg: #f2d7d5;
            --danger-border: #e6b0aa;
            --danger-color: #c0392b;
        }

        body {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            background-color: #f9f9f9;
        }

        nav {
            margin-bottom: 24px;
            padding: 10px 0;
            border-bottom: 2px solid var(--border-color);
        }

        nav a,
        a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

        .flash {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: #1b4f72;
            padding: 10px;
            margin: 12px 0;
        }

        .danger {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-color);
            padding: 10px;
            margin: 12px 0;
        }

        .field {
            margin-bottom: 14px;
        }

        .field label {
            display: block;
            font-weight: bold;
            margin-bottom: 4px;
        }

        input {
            padding: 7px;
            min-width: 280px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
        }

        button,
        .button {
            display: inline-block;
            padding: 7px 12px;
            cursor: pointer;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
        }

        .toolbar {
            display: flex;
            gap: 16px;
            align-items: center;
            justify-content: space-between;
            margin: 16px 0;
            flex-wrap: wrap;
        }

        .search-form {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            background: white;
        }

        th,
        td {
            border: 1px solid var(--border-color);
            padding: 8px;
            text-align: left;
        }

        th {
            background: #e5e8e8;
        }

        .actions {
            white-space: nowrap;
        }

        .actions form {
            display: inline;
            margin-left: 8px;
        }

        .danger-button {
            background-color: var(--danger-color);
        }

        .pagination {
            margin-top: 18px;
        }

        .pagination svg,
        nav[role="navigation"] svg {
            width: 18px;
            height: 18px;
        }
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('aprendices.index') }}">
            Aprendices
        </a>
    </nav>

    @if (session('ok'))
        <div class="flash">
            {{ session('ok') }}
        </div>
    @endif

    @yield('content')

</body>
</html>
