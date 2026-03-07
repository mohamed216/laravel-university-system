<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Register') }} - {{ config('app.name', 'University System') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px;
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <i class="bi bi-mortarboard-fill fs-1"></i>
            <h3 class="mt-2">{{ __('University System') }}</h3>
            <p class="mb-0">{{ __('Register') }}</p>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Register as') }}</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="student">{{ __('Student') }}</option>
                        <option value="professor">{{ __('Professor') }}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-register w-100">
                    <i class="bi bi-person-plus"></i> {{ __('Register') }}
                </button>
            </form>

            <hr>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    {{ __('Login') }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>
