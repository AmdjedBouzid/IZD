<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        a {
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }
        a:hover {
            color: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="card">
            <a href="{{ route('services.index') }}">📋 Manage Services</a>
        </div>

        <div class="card">
            <a href="{{ route('companies.index') }}">🏢 Manage Companies</a>
        </div>

        <div class="card">
            <a href="{{ route('banners.index') }}">🖼 Manage Banners</a>
        </div>

        <div class="card">
            <a href="{{ route('messages.index') }}">✉ View Messages</a>
        </div>

        <div class="card">
            <a href="{{ route('contacts.index') }}">📞 Manage Contacts</a>
        </div>
    </div>
</body>
</html>
