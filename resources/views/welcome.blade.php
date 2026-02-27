@extends('layout')

@section('conteudo')

  <div class="container">
    <div class="tabs">
      <div class="tab active" data-tab="login">Login</div>
      <div class="tab" data-tab="register">Registrar</div>
    </div>

    <div class="form-container">

      <div class="logo">OnTelaria</div>

      <!-- ========== FORMULÁRIO DE LOGIN ========== -->
      <form id="loginForm" class="auth-form">
        <h1>Entrar no Sistema</h1>

        <div class="form-group">
          <label for="login-email">Email / Usuário</label>
          <input 
            type="text" 
            id="login-email" 
            placeholder="seu@email.com ou usuário"
            required
          >
        </div>

        <div class="form-group password-group">
          <label for="login-password">Senha</label>
          <input 
            type="password" 
            id="login-password" 
            placeholder="••••••••"
            required
          >
        </div>

        <button type="submit">Entrar</button>

        <div class="extras">
          <a href="#">Esqueci minha senha</a>
        </div>
      </form>

      <!-- ========== FORMULÁRIO DE REGISTRO ========== -->
      <form id="registerForm" class="auth-form hidden">
        <h1>Criar Conta</h1>

        <div class="form-group">
          <label for="reg-nome">Nome completo</label>
          <input type="text" id="reg-nome" placeholder="João Silva" required>
        </div>

        <div class="form-group">
          <label for="reg-email">Email</label>
          <input type="email" id="reg-email" placeholder="seu@email.com" required>
        </div>

        <div class="form-group password-group">
          <label for="reg-password">Senha</label>
          <input type="password" id="reg-password" placeholder="Mínimo 8 caracteres" required>
          
        </div>

        <div class="form-group password-group">
          <label for="reg-password2">Confirmar senha</label>
          <input type="password" id="reg-password2" placeholder="Repita a senha" required>
        </div>

        <button type="submit">Criar conta</button>

        <div class="extras">
          Já tem conta? <a href="#" class="switch-to-login">Faça login</a>
        </div>
      </form>

    </div>
  </div>

  <script>
    // ========== Alternar entre login e registro ==========
    const tabs = document.querySelectorAll('.tab');
    const forms = {
      login: document.getElementById('loginForm'),
      register: document.getElementById('registerForm')
    };

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const target = tab.dataset.tab;
        Object.values(forms).forEach(f => f.classList.add('hidden'));
        forms[target].classList.remove('hidden');
      });
    });

    // Links para alternar (no rodapé do registro)
    document.querySelectorAll('.switch-to-login').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector('.tab[data-tab="login"]').click();
      });
    });

    // Mostrar/esconder senha (ambos os formulários)
    document.querySelectorAll('.toggle-password').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = btn.previousElementSibling;
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        btn.textContent = type === 'password' ? '👁️' : '🙈';
      });
    });

    // Prevenção de submit (apenas demonstração)
    document.querySelectorAll('.auth-form').forEach(form => {
      form.addEventListener('submit', e => {
        e.preventDefault();
        alert('Formulário enviado! (simulação)\n\n' + 
              'Ação: ' + (form.id === 'loginForm' ? 'Login' : 'Registro'));
        // Aqui você colocaria fetch() para sua API
      });
    });
  </script>