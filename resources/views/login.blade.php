@extends('layoutLogin')

@section('conteudo')
  <style>
    /* Esconde o formulário que tiver a classe hidden */
.hidden {
  display: none !important;
}

/* Estilo para a aba ativa (opcional, para feedback visual) */
.tab {
  cursor: pointer;
  padding: 10px 20px;
}

.tab.active {
  border-bottom: 2px solid #000; /* Ou a cor do seu sistema */
  font-weight: bold;
}
  </style>
  <div class="container">
    <div class="tabs">
      <div class="tab active" data-tab="login">Login</div>
      <div class="tab" data-tab="register">Registrar</div>
    </div>

    <div class="form-container">

      <div class="logo">OnTelaria</div>

      <!-- ========== FORMULÁRIO DE LOGIN ========== -->
      <form id="loginForm" class="auth-form" method="POST" action="{{ route('login.post') }}">
          @csrf
          <h1>Entrar no Sistema</h1>

          @if ($errors->has('email'))
              <div class="alert-error">{{ $errors->first('email') }}</div>
          @endif

          <div class="form-group">
              <label for="login-email">Email / Usuário</label>
              <input 
                  type="text" 
                  id="login-email"
                  name="email"
                  value="{{ old('email') }}"
                  placeholder="seu@email.com ou usuário"
                  required
              >
          </div>

          <div class="form-group password-group">
              <label for="login-password">Senha</label>
              <input 
                  type="password" 
                  id="login-password"
                  name="password"
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
      <form id="registerForm" class="auth-form hidden" method="POST" action="{{ route('register.post') }}">
          @csrf
          <h1>Criar Conta</h1>

          @if ($errors->any() && old('_form') === 'register')
              <div class="alert-error">
                  <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
              </div>
          @endif

          <input type="hidden" name="_form" value="register">

          <div class="form-group">
              <label for="reg-nome">Nome completo</label>
              <input type="text" id="reg-nome" name="nome" value="{{ old('nome') }}" placeholder="João Silva" required>
          </div>

          <div class="form-group">
              <label for="reg-email">Email</label>
              <input type="email" id="reg-email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required>
          </div>

          <div class="form-group password-group">
              <label for="reg-password">Senha</label>
              <input type="password" id="reg-password" name="password" placeholder="Mínimo 8 caracteres" required>
          </div>

          <div class="form-group password-group">
              <label for="reg-password2">Confirmar senha</label>
              <input type="password" id="reg-password2" name="password_confirmation" placeholder="Repita a senha" required>
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
        e.preventDefault(); // Impede a página de recarregar
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

    window.addEventListener('DOMContentLoaded', () => {
      const activeForm = "{{ old('_form') }}"; 
      if (activeForm === 'register') {
          document.querySelector('.tab[data-tab="register"]').click();
      }
  });
  </script>