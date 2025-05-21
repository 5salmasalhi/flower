<x-guest-layout>
    <style>
        .form-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgb(168, 40, 40);
            color: black;
        }

        .form-title {
            /* color: #fff; */
            font-size: 28px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-label {
            /* color: #fff; */
            font-size: 14px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            /* color: rgba(255, 255, 255, 0.8); */
            pointer-events: none;
        }

        .form-input {
             width: 100%;
            background: rgba(255, 255, 255, 0.1) !important;
            /* border: none !important; */
            border: 2px solid rgb(168, 40, 40);

            /* color: #fff !important; */
            padding-left: 2.5rem !important;
        }

        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.2) !important;
        }

        .form-input::placeholder {
            /* color: rgba(255, 255, 255, 0.8); */
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            /* color: rgba(255, 255, 255, 0.8); */
            cursor: pointer;
            padding: 0;
        }

        .bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
        }

        .login-link {
            /* color: #fff !important; */
            text-decoration: none !important;
            font-size: 14px;
            opacity: 0.9;
        }

        .register-btn {
            /* width: 100%; */
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(168, 40, 40) !important;
            /* color: #fff !important; */
            border: none !important;
            transition: background 0.3s;
        }

        .register-btn:hover {
            background: rgba(255, 40, 40) !important;
        }

        .error-message {
            color: #fca5a5;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
    </style>

    <div class="form-container">
        <h1 class="form-title">Create Account</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label class="form-label">Name</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <x-text-input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="error-message" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Enter your password" />
                    <button type="button" class="password-toggle" onclick="togglePassword(this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
                    <button type="button" class="password-toggle" onclick="togglePassword(this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
            </div>

            <div class="bottom-content">
                <a class="login-link" href="{{ route('login') }}">
                    Already have an account? Login
                </a>
                <x-primary-button class="register-btn">
                    Register
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        function togglePassword(button) {
            const input = button.parentElement.querySelector('input');
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
