@extends('layout')

@section('conteudo')

  <section class="hero">
    <div class="hero-content">
      <h1>Bem-vindo ao OnTelaria</h1>
      <p>Experiência de luxo e conforto em um dos hotéis víntage mais prestigiados da cidade</p>
      
      <div class="hero-buttons">
        <a href="#" class="btn-primary">Reserve Agora</a>
        <a href="#" class="btn-outline">Ver Quartos</a>
      </div>
    </div>
  </section>

<section id="sobre">
  <div class="container">
    <div class="texto">
      <h2>Sobre o OnTelaria</h2>
      <div class="subtitulo">Uma experiência de hospedagem excepcional desde 1985</div>
      
      <div class="texto-columns">
        <p>O OnTelaria combina elegância clássica com comodidades modernas para proporcionar uma estadia inesquecível. Localizado no coração da cidade, nosso hotel oferece fácil acesso aos principais pontos turísticos, centros comerciais e áreas de negócios.</p>
        
        <p>Com mais de 35 anos de tradição em hospitalidade, nos dedicamos a oferecer um serviço impecável e criar momentos memoráveis para cada hóspede. Nossas instalações foram cuidadosamente projetadas para seu conforto e bem-estar.</p>
        
        <p>Seja para uma viagem de negócios, férias em família ou uma escapada romântica, o OnTelaria é seu refúgio perfeito.</p>
      </div>
    </div>

    <div class="cards">
      <div class="card">
        <div class="icone">★</div>
        <div class="numero">4.9</div>
        <div class="label">Avaliação Média</div>
      </div>
      
      <div class="card">
        <div class="icone">🏆</div>
        <div class="numero">15+</div>
        <div class="label">Prêmios</div>
      </div>
      
      <div class="card">
        <div class="icone">⏰</div>
        <div class="numero">24/7</div>
        <div class="label">Atendimento</div>
      </div>
      
      <div class="card">
        <div class="icone">📍</div>
        <div class="numero">Bosque</div>
        <div class="label">Localização</div>
      </div>
    </div>
  </div>
</section>

<section id="quartos">
  <h2>Nossos Quartos</h2>
  <div class="subtitulo">O máximo em luxo e conforto com vista panorâmica</div>
  <p class="descricao">Cada quarto foi projetado pensando no seu conforto e tranquilidade</p>

  <div class="quartos-grid">

    <!-- Quarto Suíte -->
    <div class="quarto-card">
      <img src="https://images.unsplash.com/photo-1611892440504-42a79208a498?w=800" alt="Suíte" class="quarto-imagem">
      <div class="quarto-conteudo">
        <h3 class="quarto-titulo">Suíte</h3>
        <p class="quarto-desc">Confortável e aconchegante, perfeito para viajantes solo, casais e famílias pequenas.</p>
        
        <div class="quarto-detalhes">
          <div class="detalhe-item">🛏️ <span>30m²</span></div>
          <div class="detalhe-item">👤 <span>3 pessoas</span></div>
          <div class="detalhe-item">📶 <span>Wi-Fi Grátis</span></div>
        </div>
        
        <div class="preco">R$ 100/noite</div>
        <a href="#" class="btn-reservar">Reservar</a>
      </div>
    </div>

    <!-- Luxo Duplo -->
    <div class="quarto-card">
      <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=800" alt="Luxo Duplo" class="quarto-imagem">
      <div class="quarto-conteudo">
        <h3 class="quarto-titulo">Suíte Deluxe</h3>
        <p class="quarto-desc">Espaçosa e elegante, perfeito para compartilhar com os melhores amigos.</p>
        
        <div class="quarto-detalhes">
          <div class="detalhe-item">🛏️ <span>45m²</span></div>
          <div class="detalhe-item">👥 <span>4 pessoas</span></div>
          <div class="detalhe-item">📶 <span>Wi-Fi Grátis</span></div>
        </div>
        
        <div class="preco">R$ 200/noite</div>
        <a href="#" class="btn-reservar">Reservar</a>
      </div>
    </div>

    <!-- Suíte Premium -->
    <div class="quarto-card">
      <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800" alt="Suíte Premium" class="quarto-imagem">
      <div class="quarto-conteudo">
        <h3 class="quarto-titulo">Luxo Triplo</h3>
        <p class="quarto-desc">Muito espaço com o luxo de um acampamento tranquilo.</p>
        
        <div class="quarto-detalhes">
          <div class="detalhe-item">🛏️ <span>65m²</span></div>
          <div class="detalhe-item">👥 <span>4 pessoas</span></div>
          <div class="detalhe-item">📶 <span>Wi-Fi Grátis</span></div>
        </div>
        
        <div class="preco">R$ 300/noite</div>
        <a href="#" class="btn-reservar">Reservar</a>
      </div>
    </div>

    <!-- Luxo Casal -->
    <div class="quarto-card">
      <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800" alt="Suíte Premium" class="quarto-imagem">
      <div class="quarto-conteudo">
        <h3 class="quarto-titulo">Luxo Casal</h3>
        <p class="quarto-desc">O máximo em luxo e conforto para você dividar com o amor da sua vida.</p>
        
        <div class="quarto-detalhes">
          <div class="detalhe-item">🛏️ <span>20m²</span></div>
          <div class="detalhe-item">👥 <span>2 pessoas</span></div>
          <div class="detalhe-item">📶 <span>Wi-Fi Grátis</span></div>
        </div>
        
        <div class="preco">R$ 50/noite</div>
        <a href="#" class="btn-reservar">Reservar</a>
      </div>
    </div>

    <!-- Suíte Conjugada -->
    <div class="quarto-card">
      <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800" alt="Suíte Conjugada" class="quarto-imagem">
      <div class="quarto-conteudo">
        <h3 class="quarto-titulo">Suíte Conjugada</h3>
        <p class="quarto-desc">O máximo em luxo e conforto com vista panorâmica.</p>
        
        <div class="quarto-detalhes">
          <div class="detalhe-item">🛏️ <span>75m²</span></div>
          <div class="detalhe-item">👥 <span>5 pessoas</span></div>
          <div class="detalhe-item">📶 <span>Wi-Fi Grátis</span></div>
        </div>
        
        <div class="preco">R$ 600/noite</div>
        <a href="#" class="btn-reservar">Reservar</a>
      </div>
    </div>

    <!-- Apartamento mini -->
    <div class="quarto-card">
      <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800" alt="Suíte Conjugada" class="quarto-imagem">
      <div class="quarto-conteudo">
        <h3 class="quarto-titulo">Apartamento mini</h3>
        <p class="quarto-desc">O máximo em luxo com vista panorâmica para o bosque sem abandonar o conforto do coração da cidade.</p>
        
        <div class="quarto-detalhes">
          <div class="detalhe-item">🛏️ <span>100m²</span></div>
          <div class="detalhe-item">👥 <span>6 pessoas</span></div>
          <div class="detalhe-item">📶 <span>Wi-Fi Grátis</span></div>
        </div>
        
        <div class="preco">R$ 1000/noite</div>
        <a href="#" class="btn-reservar">Reservar</a>
      </div>
    </div>

  </div>
</section>

  