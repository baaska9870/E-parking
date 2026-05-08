<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }
        nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 0 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }
        .navbar-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        .navbar-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }
        .navbar-menu a:hover {
            opacity: 0.8;
        }
        .logout-btn {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 5px;
            color: white;
            border: 1px solid white;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }
        .logout-btn:hover {
            background: white;
            color: #667eea;
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .welcome-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 32px;
        }
        .user-email {
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .content {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .content h2 {
            color: #333;
            margin-bottom: 15px;
        }
        .content p {
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <nav>
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">E-Parking</a>
            <div class="navbar-menu">
                <span style="color: white;">Welcome, {{ $user->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h1>Welcome, {{ $user->name }}! 👋</h1>
            <p class="user-email">{{ $user->email }}</p>
            <p>You have successfully logged in to your account.</p>
        </div>

        <div class="content">
            <h2>Dashboard</h2>
            <p>This is your protected dashboard. Only authenticated users can view this page.</p>
            
            <h2 style="margin-top: 30px;">User Information</h2>
            <div style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin-top: 15px;">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Member Since:</strong> {{ $user->created_at->format('F d, Y') }}</p>
                <p><strong>Last Updated:</strong> {{ $user->updated_at->format('F d, Y \a\t H:i') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
