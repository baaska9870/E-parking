<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Section</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f4ff; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,.08); }
        h1 { color: #1e3a8a; }
        .actions { margin-top: 18px; }
        .actions a, .actions form { margin-right: 12px; }
        .actions button { padding: 8px 14px; border: 0; background: #6c63ff; color: white; border-radius: 6px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Console</h1>
        <p>Тавтай морилно уу, {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
        <p>Энд админ ажилбарууд байрлана.</p>

        <div class="actions">
            <a href="{{ route('map') }}">Map</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
