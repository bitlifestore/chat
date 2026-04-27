<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - WhatsApp Clone</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 350px;
            text-align: center;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 2px solid #f0f2f5;
        }
        .tab {
            flex: 1;
            padding: 10px;
            cursor: pointer;
            color: #666;
            font-weight: bold;
            transition: 0.3s;
        }
        .tab.active {
            color: #25D366;
            border-bottom: 2px solid #25D366;
        }
        h2 {
            margin-bottom: 10px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }
        input:focus {
            border-color: #25D366;
        }
        button {
            padding: 12px;
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #1ebb55;
        }
        .error-list {
            color: #d93025;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: left;
            background: #fdf2f2;
            padding: 10px;
            border-radius: 5px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>WhatsApp Clone</h2>
        
        <div class="tabs">
            <div id="login-tab" class="tab active" onclick="showForm('login')">Login</div>
            <div id="register-tab" class="tab" onclick="showForm('register')">Register</div>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="error-list">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <!-- Register Form -->
        <form id="register-form" class="hidden" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>

    <script>
        function showForm(type) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const loginTab = document.getElementById('login-tab');
            const registerTab = document.getElementById('register-tab');

            if (type === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginTab.classList.add('active');
                registerTab.classList.remove('active');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                loginTab.classList.remove('active');
                registerTab.classList.add('active');
            }
        }

        // If there are errors related to registration, show register tab
        @if ($errors->has('name') || $errors->has('phone'))
        <script>
            showForm('register');
        </script>
        @endif
    </script>
</body>
</html>
                                                        
