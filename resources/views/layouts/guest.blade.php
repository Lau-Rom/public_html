<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Nacional de Fomento Musical</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0 !important;
            font-family: Arial, Helvetica, sans-serif !important;
            background: #4A102B !important;
        }

        .login-page {
            min-height: 100vh !important;
            background: linear-gradient(135deg, #4A102B, #6A1B3F, #7D244A) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 24px !important;
            box-sizing: border-box !important;
        }

        .login-box {
            width: 100% !important;
            max-width: 430px !important;
            box-sizing: border-box !important;
        }

        .login-header {
            text-align: center !important;
            margin-bottom: 24px !important;
        }

        .login-header h1 {
            color: #fff !important;
            font-size: 28px !important;
            font-weight: 700 !important;
            margin: 0 0 8px !important;
        }

        .login-header p {
            color: #F5F1E8 !important;
            margin: 0 !important;
            font-size: 16px !important;
        }

        .login-card {
            background: #fff !important;
            border-radius: 18px !important;
            padding: 32px !important;
            box-shadow: 0 20px 45px rgba(0, 0, 0, .28) !important;
            border-top: 6px solid #B38E5D !important;
            box-sizing: border-box !important;
        }

        .login-card label {
            color: #4A102B !important;
            font-weight: 600 !important;
        }

        .login-card input[type="text"],
        .login-card input[type="email"],
        .login-card input[type="password"] {
            width: 100% !important;
            border: 1px solid #D1D5DB !important;
            border-radius: 10px !important;
            padding: 12px 14px !important;
            background: #F9FAFB !important;
            box-sizing: border-box !important;
            color: #111827 !important;
            -webkit-text-fill-color: #111827 !important;
        }

        .login-card input::placeholder {
            color: #6B7280 !important;
            opacity: 1 !important;
        }

        .login-card button {
            width: 100% !important;
            background: linear-gradient(135deg, #6A1B3F, #4A102B) !important;
            color: white !important;
            border-radius: 10px !important;
            padding: 13px 20px !important;
            font-weight: 700 !important;
            margin-top: 16px !important;
            box-sizing: border-box !important;
        }

        @media (max-width: 640px) {
            .login-page {
                padding: 16px !important;
            }

            .login-box {
                max-width: 100% !important;
            }

            .login-card {
                padding: 20px !important;
            }

            .login-header h1 {
                font-size: 24px !important;
            }
        }
    </style>
</head>

<body>
    <main class="login-page">
        <div class="login-box">

            <div class="login-header">
                <h1>Sistema Nacional de Fomento Musical</h1>
            </div>

            <div class="login-card">
                {{ $slot }}
            </div>

        </div>
    </main>
</body>

</html>
