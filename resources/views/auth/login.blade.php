<x-guest-layout>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        }

        .form-container {
            background: rgb(168, 40, 40);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 2rem;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 2rem;
        }

        .welcome-text h1 {
            color: #fff;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .welcome-text p {
            color: #fff;
            font-size: 1rem;
            opacity: 0.9;
        }

        .form-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.1) !important;
            border: none !important;
            color: #fff !important;
            padding-left: 2.5rem !important;
        }

        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.2) !important;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #fff;
        }

        .forgot-password {
            color: #fff;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .login-btn {
            width: 100%;
            background: rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            border: none !important;
            transition: background 0.3s;
        }

        .login-btn:hover {
            background: rgba(255, 255, 255, 0.2) !important;
        }

        .register-link {
            text-align: center;
            color: #fff;
            margin-top: 1rem;
        }

        .register-link a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="form-container">
        <div class="welcome-text">
            <h1>Welcome Back</h1>
            <p>Please login to your account to access our flower shop services.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email Address" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <x-text-input id="password" class="form-input"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <x-primary-button class="login-btn">
                Log in
            </x-primary-button>

            <div class="register-link">
                Don't have an account? <a href="{{ route('register') }}">Register Now</a>
            </div>
        </form>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</x-guest-layout>
