<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>OnTelaria • Acesso</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}?v=2">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

  <style>
    /* =============================================
   Parte 1: Estilos gerais do site (header, hero, sobre, quartos)
   ============================================= */

:root {
    --primaria: #BF4646;
    --secundaria: #7EACB5;
    --bege: #EDDCC6;
    --clara: #FFF4EA;
    --escuro: #111;
    --cinza: #333;
    --success: #4CAF50;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: system-ui, -apple-system, sans-serif;
    background: var(--clara);
    color: var(--escuro);
    line-height: 1.5;
}

header {
    position: fixed;
    top: 0;
    width: 100%;
    background: white;
    border-bottom: 1px solid #eee;
    z-index: 10;
}

nav {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--primaria);
}

.menu {
    display: flex;
    gap: 2rem;
    list-style: none;
}

.menu a {
    color: var(--cinza);
    text-decoration: none;
    font-size: 1rem;
}

.menu a:hover {
    color: var(--secundaria);
}

.btn-reserva {
    background: var(--primaria);
    color: white;
    padding: 0.6rem 1.4rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
}

.btn-reserva:hover {
    background: #a53737;
}

.hero {
    height: 100vh;
    min-height: 600px;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.5)),
                url('https://thumbs.dreamstime.com/b/hotel-room-night-city-view-modern-interior-design-inviting-comfy-bed-scenic-offering-relaxing-travel-experience-391039258.jpg') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    padding: 0 5%;
}

.hero-content {
    max-width: 800px;
}

.hero h1 {
    font-size: 3.8rem;
    margin-bottom: 1.2rem;
    font-weight: 700;
}

.hero p {
    font-size: 1.4rem;
    margin-bottom: 2.5rem;
    opacity: 0.95;
}

.hero-buttons {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary {
    background: var(--primaria);
    color: white;
    padding: 1rem 2.2rem;
    border-radius: 6px;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 600;
    border: none;
}

.btn-primary:hover {
    background: #d14e4e;
}

.btn-outline {
    background: transparent;
    color: white;
    padding: 1rem 2.2rem;
    border: 2px solid var(--secundaria);
    border-radius: 6px;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 600;
}

.btn-outline:hover {
    background: var(--secundaria);
    color: white;
}

@media (max-width: 768px) {
    .hero h1 { font-size: 2.8rem; }
    .hero p { font-size: 1.2rem; }
    .menu { gap: 1.2rem; font-size: 0.95rem; }
    .hero-buttons { flex-direction: column; gap: 1rem; }
    nav { flex-direction: column; gap: 1rem; padding: 1.2rem 5%; }
}
#sobre {
  padding: 7rem 5% 6rem;
  background: var(--clara);
}

#sobre .container {
  max-width: 1300px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;           /* duas colunas principais */
  gap: 5rem 7rem;
  align-items: start;                       /* alinha no topo */
  padding: 50px 100px;
}

#sobre .texto {
  max-width: 620px;
}

#sobre .texto h2 {
  font-size: clamp(2.8rem, 5vw, 3.8rem);
  font-weight: 800;
  color: var(--escuro);
  margin-bottom: 0.8rem;
  line-height: 1.1;
}

#sobre .subtitulo {
  font-size: 1.45rem;
  color: var(--secundaria);
  font-weight: 500;
  margin-bottom: 1.8rem;
  line-height: 1.4;
}

#sobre .texto-columns {
  column-count: 2;                          /* divide o texto em 2 colunas */
  column-gap: 3rem;
  font-size: 1.1rem;
  line-height: 1.8;
  color: #444;
}

#sobre .texto-columns p {
  margin-bottom: 1.4rem;
  break-inside: avoid;                      /* evita quebrar parágrafo no meio */
}

/* Cards */
#sobre .cards {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.8rem 2rem;
  max-width: 620px;
}

#sobre .card {
  background: white;
  border-radius: 14px;
  padding: 1.8rem 1.4rem;
  text-align: center;
  box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  transition: all 0.3s ease;
}

#sobre .card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 32px rgba(191,70,70,0.12);
}

#sobre .icone {
  width: 64px;
  height: 64px;
  line-height: 64px;
  background: var(--primaria);
  color: white;
  border-radius: 50%;
  font-size: 1.9rem;
  margin: 0 auto 1rem;
}

#sobre .numero {
  font-size: 2.8rem;
  font-weight: 800;
  color: var(--primaria);
  line-height: 1;
  margin-bottom: 0.4rem;
}

#sobre .label {
  font-size: 1.05rem;
  color: #555;
  font-weight: 500;
}

/* Responsividade */
@media (max-width: 1100px) {
  #sobre .container {
    grid-template-columns: 1fr;
    gap: 4rem;
  }
  
  #sobre .texto-columns {
    column-count: 1;                        /* volta para 1 coluna */
  }
  
  #sobre .cards {
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    max-width: 100%;
  }
}

@media (max-width: 768px) {
  #sobre {
    padding: 5rem 6% 4rem;
  }

  #sobre .container {
      padding: 30px 20px;
  }
  
  #sobre .texto h2 {
    font-size: 2.6rem;
    text-align: center;
  }
  
  #sobre .subtitulo {
    text-align: center;
  }
  
  #sobre .texto-columns {
    font-size: 1.05rem;
  }
}

#quartos {
    padding: 6rem 5%;
    background: var(--bege);
    text-align: center;
}

#quartos h2 {
    font-size: 3.2rem;
    font-weight: 700;
    color: #111;
    margin-bottom: 0.8rem;
}

#quartos .subtitulo {
    font-size: 1.4rem;
    color: var(--secundaria);
    margin-bottom: 1rem;
    font-weight: 400;
}

#quartos .descricao {
    font-size: 1.2rem;
    color: #555;
    margin-bottom: 3rem;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

#quartos .quartos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2.5rem;
    max-width: 1200px;
    margin: 0 auto;
}

#quartos .quarto-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

#quartos .quarto-card:hover {
    transform: translateY(-8px);
}

#quartos .quarto-imagem {
    width: 100%;
    height: 240px;
    object-fit: cover;
}

#quartos .quarto-conteudo {
    padding: 1.8rem 1.5rem;
}

#quartos .quarto-titulo {
    font-size: 1.6rem;
    font-weight: 600;
    color: #111;
    margin-bottom: 0.8rem;
}

#quartos .quarto-desc {
    font-size: 1.05rem;
    color: #666;
    margin-bottom: 1.2rem;
}

#quartos .quarto-detalhes {
    display: flex;
    flex-wrap: wrap;
    gap: 1.2rem;
    margin-bottom: 1.5rem;
    font-size: 1rem;
    color: #555;
}

#quartos .detalhe-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

#quartos .detalhe-item span {
    font-weight: 500;
}

#quartos .preco {
    font-size: 1.8rem;
    font-weight: bold;
    color: var(--primaria);
    margin-bottom: 1.2rem;
}

#quartos .btn-reservar {
    background: var(--primaria);
    color: white;
    padding: 0.9rem 2rem;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
    display: inline-block;
    text-decoration: none;
}

#quartos .btn-reservar:hover {
    background: #a53737;
}

@media (max-width: 768px) {
    #quartos h2 { font-size: 2.6rem; }
    #quartos .subtitulo { font-size: 1.3rem; }
    #quartos .quarto-imagem { height: 220px; }
}

/* =============================================
   Parte 2: Estilos da página de login/cadastro
   ============================================= */

.container {
    background: var(--bege);
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(191, 70, 70, 0.12);
    overflow: hidden;
    width: 100%;
    max-width: 440px;
    margin: 150px auto;
}

.tabs {
    display: flex;
    background: var(--secundaria);
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
    background: var(--primaria);
    border-bottom: 4px solid var(--primaria);
}

.tab:hover:not(.active) {
    background: rgba(191, 70, 70, 0.15);
}

.form-container {
    padding: 2.2rem 2rem;
    background: var(--clara);
}

h1 {
    text-align: center;
    color: var(--primaria);
    font-size: 1.7rem;
    margin-bottom: 1.8rem;
    font-weight: 700;
}

.form-group {
    margin-bottom: 1.4rem;
    position: relative;
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
    border: 2px solid var(--bege);
    border-radius: 10px;
    font-size: 1rem;
    background: white;
    transition: all 0.25s;
}

input:focus {
    outline: none;
    border-color: var(--primaria);
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
    color: var(--secundaria);
    cursor: pointer;
    font-size: 1.3rem;
}

button {
    width: 100%;
    padding: 1.05rem;
    background: var(--primaria);
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
    color: var(--secundaria);
    text-decoration: none;
    font-weight: 500;
}

.extras a:hover {
    color: var(--primaria);
    text-decoration: underline;
}

.hidden {
    display: none;
}

@media (max-width: 480px) {
    .container {
      margin: 40px 15px;
      padding: 0 10px;
    }
    .form-container {
      padding: 2rem 1.4rem;
    }
}

    /* =============================================
       Footer Styles
       ============================================= */

    footer {
      background: var(--escuro);
      color: white;
      padding: 4rem 5% 2rem;
    }

    .footer-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 3rem 2rem;
    }

    .footer-col h3 {
      font-size: 1.6rem;
      margin-bottom: 1rem;
      color: var(--secundaria);
    }

    .footer-col h4 {
      font-size: 1.2rem;
      margin-bottom: 1.2rem;
      color: white;
      position: relative;
      padding-bottom: 0.6rem;
    }

    .footer-col h4::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 2px;
      background: var(--primaria);
    }

    .footer-col p {
      color: #ccc;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    .social {
      display: flex;
      color: white;
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .social a {
      width: 36px;
      height: 36px;
      background: rgba(255,255,255,0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.3rem;
      transition: all 0.3s;
    }

    .social a:hover {
      background: var(--primaria);
      transform: translateY(-3px);
    }

    .footer-col ul {
      list-style: none;
    }

    .footer-col ul li {
      margin-bottom: 0.9rem;
    }

    .footer-col a {
      color: #ccc;
      text-decoration: none;
      transition: color 0.3s;
    }

    .footer-col a:hover {
      color: var(--secundaria);
    }

    .contact-info li {
      margin-bottom: 1rem;
      color: #ddd;
    }

    .footer-bottom {
      max-width: 1200px;
      margin: 3rem auto 0;
      padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,0.12);
      text-align: center;
      color: #aaa;
      font-size: 0.95rem;
    }

    .footer-bottom p {
      margin-bottom: 0.8rem;
    }

    .legal a {
      color: #bbb;
      text-decoration: none;
      margin: 0 0.8rem;
    }

    .legal a:hover {
      color: white;
    }

    @media (max-width: 768px) {
      footer {
        padding: 3rem 5% 2rem;
      }
      
      .footer-container {
        gap: 2.5rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <nav>
        <a href="/" class="logo" style="text-decoration: none;">
            ON<span style="color: var(--secundaria)">TELARIA</span>
        </a>

        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <ul class="menu">
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="{{ route('quartos.index') }}">Quartos</a></li>
            <li><a href="#servicos">Serviços</a></li>
            <li><a href="#contato">Contato</a></li>
            <li>
                <a href="{{ route('quartos.create') }}" class="btn-reserva">
                    Nova Reserva
                </a>
            </li>
        </ul>
    </nav>
</header>

<style>
    /* CSS Complementar para a funcionalidade da Navbar */

    /* Esconde o checkbox */
    .menu-toggle {
        display: none;
    }

    /* Estilização do Menu */
    .menu {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0;
    }

    .menu li {
        list-style: none;
    }

    /* Responsividade (Mobile) */
    @media (max-width: 768px) {
        .hamburger {
            display: flex;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 20;
        }

        .hamburger span {
            display: block;
            width: 28px;
            height: 3px;
            background: var(--escuro);
            transition: 0.3s;
            border-radius: 2px;
        }

        .menu {
            position: fixed;
            top: 0;
            right: -100%; /* Escondido fora da tela */
            width: 70%;
            height: 100vh;
            background: white;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2.5rem !important;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            transition: 0.4s ease-in-out;
            z-index: 15;
        }

        /* Quando o checkbox estiver marcado, mostra o menu */
        .menu-toggle:checked ~ .menu {
            right: 0;
        }

        /* Efeito de X no hambúrguer quando aberto */
        .menu-toggle:checked ~ .hamburger span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }
        .menu-toggle:checked ~ .hamburger span:nth-child(2) {
            opacity: 0;
        }
        .menu-toggle:checked ~ .hamburger span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .btn-reserva {
            width: 80%;
            text-align: center;
        }
    }
</style>
    @yield('conteudo')
    
    <footer>
    <div class="footer-container">
      <div class="footer-col">
        <h3>OnTelaria</h3>
        <p>Experiência de luxo e conforto desde 1985</p>
        
        <div class="social">
          <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Links Úteis</h4>
        <ul>
          <li><a href="#">Início</a></li>
          <li><a href="#sobre">Sobre</a></li>
          <li><a href="#quartos">Quartos</a></li>
          <li><a href="#">Comodidades</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Contato</h4>
        <ul class="contact-info">
          <li><i class="bi bi-pin-map-fill"></i> Av. Principal, 1234 - Centro</li>
          <li><i class="bi bi-geo-alt"></i> Presidente Prudente - SP</li>
          <li><i class="bi bi-telephone"></i> (18) 99999-8888</li>
          <li><i class="bi bi-envelope"></i> contato@ontelaria.com.br</li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Horário</h4>
        <ul class="contact-info">
          <li>Recepção 24 horas</li>
          <li>Check-in: 08:00 às 14:00</li>
          <li>Check-out: 13:00 às 18:00</li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2026 OnTelaria. Todos os direitos reservados.</p>
      <div class="legal">
        <a href="#">Política de Privacidade</a> • 
        <a href="#">Termos de Uso</a>
      </div>
    </div>
  </footer>
</body>
</html>