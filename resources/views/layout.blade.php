<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>OnTelaria • Acesso</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #FFF4EA;
      min-height: 100vh;
      color: #333;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .container {
      background: #EDDCC6;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(191, 70, 70, 0.12);
      overflow: hidden;
      width: 100%;
      max-width: 440px;
    }

    .tabs {
      display: flex;
      background: #7EACB5;
    }

    .tab {
      flex: 1;
      padding: 1.1rem;
      text-align: center;
      font-weight: 600;
      color: white;
      cursor: pointer;
      transition: all 0.25s;
      border-bottom: 4px solid transparent;
    }

    .tab.active {
      background: #BF4646;
      border-bottom: 4px solid #BF4646;
    }

    .tab:hover:not(.active) {
      background: rgba(191, 70, 70, 0.15);
    }

    .form-container {
      padding: 2.2rem 2rem;
      background: #FFF4EA;
    }

    h1 {
      text-align: center;
      color: #BF4646;
      font-size: 1.7rem;
      margin-bottom: 1.8rem;
      font-weight: 700;
    }

    .logo {
      text-align: center;
      margin-bottom: 1.5rem;
      font-size: 2rem;
      font-weight: 700;
      color: #7EACB5;
      letter-spacing: 1px;
    }

    .form-group {
      margin-bottom: 1.4rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      color: #444;
      font-weight: 500;
      font-size: 0.95rem;
    }

    input {
      width: 100%;
      padding: 0.95rem 1.2rem;
      border: 2px solid #EDDCC6;
      border-radius: 10px;
      font-size: 1rem;
      background: white;
      transition: all 0.25s;
    }

    input:focus {
      outline: none;
      border-color: #BF4646;
      box-shadow: 0 0 0 3px rgba(191, 70, 70, 0.15);
    }

    .password-group {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #7EACB5;
      cursor: pointer;
      font-size: 1.2rem;
    }

    button {
      width: 100%;
      padding: 1.05rem;
      background: #BF4646;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 1.05rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 1.3rem;
    }

    button:hover {
      background: #a03a3a;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(191, 70, 70, 0.3);
    }

    .extras {
      text-align: center;
      margin-top: 1.4rem;
      font-size: 0.92rem;
      color: #555;
    }

    .extras a {
      color: #7EACB5;
      text-decoration: none;
      font-weight: 500;
    }

    .extras a:hover {
      color: #BF4646;
      text-decoration: underline;
    }

    .hidden {
      display: none;
    }

    @media (max-width: 480px) {
      .container {
        margin: 10px;
      }
      .form-container {
        padding: 1.8rem 1.4rem;
      }
    }
  </style>
</head>
<body>
    @yield('conteudo')
</body>
</html>