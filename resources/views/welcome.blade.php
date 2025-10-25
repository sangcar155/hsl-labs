<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provider Dashboard Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .card {
            background: rgba(255,255,255,0.15);
            border: none;
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        h1 {
            font-weight: 700;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
        }
        a.btn {
            background-color: #ffffff;
            color: #4f46e5;
            font-weight: 600;
            border-radius: 30px;
            padding: 12px 30px;
            transition: all 0.3s ease;
        }
        a.btn:hover {
            background-color: #4f46e5;
            color: white;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Welcome to the HSL LABS Portal</h1>
        <p>Manage your supplement business efficiently — track orders, inventory, and subscriptions in one place.</p>
        <a href="{{ url('/dashboard') }}" class="btn mt-3">Go to Dashboard</a>
    </div>
</body>
</html>
