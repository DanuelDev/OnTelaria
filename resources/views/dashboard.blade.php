@extends('layout')

@section('titulo', 'Dashboard')

@section('conteudo')

@php
    $user          = auth()->user();
    $isFuncionario = $user && $user->role !== 'client';
@endphp

<div class="dash">

  <div class="dash-header">
    <div>
      <h2 class="dash-titulo">Visão Geral</h2>
      <p class="dash-sub">Resumo operacional do OnTelaria</p>
    </div>
    <a href="{{ route('reservas.create') }}" class="dash-btn">
      <i class="bi bi-plus-lg"></i> Nova Reserva
    </a>
  </div>

  {{-- ── CARDS DE NÚMEROS ── --}}
  <div class="dash-cards">

    <div class="dash-card">
      <div class="dc-icon" style="background:#fdecea; color:#BF4646">
        <i class="bi bi-door-closed-fill"></i>
      </div>
      <div class="dc-body">
        <span class="dc-label">Total de Quartos</span>
        <span class="dc-value">{{ $totalQuartos ?? 0 }}</span>
      </div>
    </div>

    <div class="dash-card">
      <div class="dc-icon" style="background:#e8f7ef; color:#16a34a">
        <i class="bi bi-door-open-fill"></i>
      </div>
      <div class="dc-body">
        <span class="dc-label">Quartos Livres</span>
        <span class="dc-value">{{ $quartosDisponiveis ?? 0 }}</span>
      </div>
    </div>

    <div class="dash-card">
      <div class="dc-icon" style="background:#e8f4ff; color:#2196F3">
        <i class="bi bi-people-fill"></i>
      </div>
      <div class="dc-body">
        <span class="dc-label">Total de Clientes</span>
        <span class="dc-value">{{ $totalClientes ?? 0 }}</span>
      </div>
    </div>

    <div class="dash-card">
      <div class="dc-icon" style="background:#f0eaff; color:#7c3aed">
        <i class="bi bi-person-check-fill"></i>
      </div>
      <div class="dc-body">
        <span class="dc-label">Clientes Ativos</span>
        <span class="dc-value">{{ $hospedesAtivos ?? 0 }}</span>
      </div>
    </div>

    <div class="dash-card">
      <div class="dc-icon" style="background:#fff8e1; color:#d97706">
        <i class="bi bi-cash-stack"></i>
      </div>
      <div class="dc-body">
        <span class="dc-label">Lucro Total</span>
        <span class="dc-value dc-value-sm">R$ {{ number_format($receitaTotal ?? 0, 0, ',', '.') }}</span>
      </div>
    </div>

    <div class="dash-card">
      <div class="dc-icon" style="background:#fff0f0; color:#BF4646">
        <i class="bi bi-journal-bookmark-fill"></i>
      </div>
      <div class="dc-body">
        <span class="dc-label">Reservas Abertas</span>
        <span class="dc-value">{{ $reservasAbertas ?? 0 }}</span>
      </div>
    </div>

  </div>

  {{-- ── GRÁFICOS + TABELA ── --}}
  <div class="dash-mid">

    {{-- Pizza: Ocupação de quartos --}}
    <div class="dash-panel">
      <h3 class="dp-titulo"><i class="bi bi-pie-chart-fill"></i> Ocupação dos Quartos</h3>
      <div class="chart-wrap">
        <canvas id="chartOcupacao"></canvas>
      </div>
      <div class="chart-legenda">
        <span class="leg-dot" style="background:#BF4646"></span> Ocupados ({{ ($totalQuartos ?? 0) - ($quartosDisponiveis ?? 0) }})
        &nbsp;&nbsp;
        <span class="leg-dot" style="background:#7EACB5"></span> Livres ({{ $quartosDisponiveis ?? 0 }})
      </div>
    </div>

    {{-- Pizza: Status das Reservas --}}
    <div class="dash-panel">
      <h3 class="dp-titulo"><i class="bi bi-pie-chart-fill"></i> Status das Reservas</h3>
      <div class="chart-wrap">
        <canvas id="chartReservas"></canvas>
      </div>
      <div class="chart-legenda" id="legendaReservas"></div>
    </div>

    {{-- Clientes ativos --}}
    <div class="dash-panel dash-panel-wide">
      <h3 class="dp-titulo"><i class="bi bi-people-fill"></i> Clientes com Estadia Ativa</h3>

      @forelse($clientesAtivos ?? [] as $estadia)
      <div class="cli-row">
          <div class="cli-avatar">{{ strtoupper(substr($estadia->reserva->nome_completo ?? $estadia->reserva->hospede->name ?? 'H', 0, 1)) }}</div>
        <div class="cli-info">
            <span class="cli-nome">{{ $estadia->reserva->nome_completo ?? $estadia->reserva->hospede->name ?? '—' }}</span>
            <span class="cli-sub">Quarto {{ $estadia->quarto->numero ?? '?' }} · Check-out: {{ \Carbon\Carbon::parse($estadia->data_checkout)->format('d/m/Y') }}</span>
        </div>
        <span class="cli-badge">Ativo</span>
      </div>
      @empty
      <p class="dash-vazio">Nenhum hóspede em estadia no momento.</p>
      @endforelse
    </div>

  </div>

  {{-- ── RESERVAS RECENTES ── --}}
  <div class="dash-panel dash-mt">
    <div class="dp-header">
      <h3 class="dp-titulo" style="margin:0"><i class="bi bi-journal-text"></i> Reservas Recentes</h3>
      <a href="{{ route('reservas.index') }}" class="dp-ver-todas">Ver todas <i class="bi bi-arrow-right"></i></a>
    </div>

    <table class="dash-table">
      <thead>
        <tr>
          <th>Hóspede</th>
          <th>Check-in</th>
          <th>Check-out</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($reservasRecentes ?? [] as $r)
        @php
          $badges = [
            'pendente'   => ['Pendente',   '#d97706', '#fff8e1'],
            'confirmada' => ['Confirmada', '#16a34a', '#e8f7ef'],
            'cancelada'  => ['Cancelada',  '#dc2626', '#fdecea'],
            'concluida'  => ['Concluída',  '#2563eb', '#e8f4ff'],
          ];
          [$bl, $bc, $bg] = $badges[$r->status ?? 'pendente'] ?? ['Pendente', '#d97706', '#fff8e1'];
        @endphp
        <tr>
          <td>{{ $r->nome_completo ?? '—' }}</td>
          <td>{{ \Carbon\Carbon::parse($r->data_inicio)->format('d/m/Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($r->data_fim)->format('d/m/Y') }}</td>
          <!-- <td>R$ {{ number_format($r->valor_total ?? 0, 0, ',', '.') }}</td> -->
          <td><span class="tb-badge" style="color:{{ $bc }};background:{{ $bg }}">{{ $bl }}</span></td>
          <td><a href="{{ route('reservas.show', $r->id) }}" class="tb-link"><i class="bi bi-eye"></i></a></td>
        </tr>
        @empty
        <tr><td colspan="6" class="dash-vazio">Nenhuma reserva encontrada.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
  // Pizza Ocupação
  new Chart(document.getElementById('chartOcupacao'), {
    type: 'doughnut',
    data: {
      labels: ['Ocupados', 'Livres'],
      datasets: [{
        data: [{{ ($totalQuartos ?? 0) - ($quartosDisponiveis ?? 0) }}, {{ $quartosDisponiveis ?? 0 }}],
        backgroundColor: ['#BF4646', '#7EACB5'],
        borderWidth: 0,
        hoverOffset: 6
      }]
    },
    options: { cutout: '65%', plugins: { legend: { display: false } } }
  });

  // Pizza Status Reservas
  const statusData = @json($reservasPorStatus ?? []);
  const cores = { pendente:'#F59E0B', confirmada:'#4CAF50', cancelada:'#ef4444', concluida:'#3b82f6' };
  const labels = Object.keys(statusData).map(k => k.charAt(0).toUpperCase() + k.slice(1));
  const values = Object.values(statusData);
  const colors = Object.keys(statusData).map(k => cores[k] ?? '#ccc');

  new Chart(document.getElementById('chartReservas'), {
    type: 'doughnut',
    data: {
      labels,
      datasets: [{ data: values, backgroundColor: colors, borderWidth: 0, hoverOffset: 6 }]
    },
    options: { cutout: '65%', plugins: { legend: { display: false } } }
  });

  // Legenda manual
  const leg = document.getElementById('legendaReservas');
  labels.forEach((l, i) => {
    leg.innerHTML += `<span class="leg-dot" style="background:${colors[i]}"></span> ${l} (${values[i]}) &nbsp;&nbsp;`;
  });
</script>

<style>
.dash {
  max-width: 1200px;
  margin: 0 auto;
  padding: 6rem 2rem 4rem;
}

.dash-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  flex-wrap: wrap;
  gap: 1rem;
}

.dash-titulo {
  font-size: 1.8rem;
  font-weight: 800;
  color: #111;
  margin: 0 0 .2rem;
}

.dash-sub {
  font-size: .9rem;
  color: #999;
  margin: 0;
}

.dash-btn {
  display: inline-flex;
  align-items: center;
  gap: .4rem;
  background: var(--primaria);
  color: white;
  padding: .6rem 1.3rem;
  border-radius: 8px;
  font-size: .9rem;
  font-weight: 600;
  text-decoration: none;
  transition: background .2s;
}

.dash-btn:hover { background: #a33; color: white; }

/* ── Cards ── */
.dash-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
  gap: 1.1rem;
  margin-bottom: 1.8rem;
}

.dash-card {
  background: white;
  border-radius: 14px;
  padding: 1.3rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  box-shadow: 0 1px 8px rgba(0,0,0,.06);
  transition: transform .2s, box-shadow .2s;
}

.dash-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(0,0,0,.09);
}

.dc-icon {
  width: 46px; height: 46px;
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.2rem;
  flex-shrink: 0;
}

.dc-label {
  display: block;
  font-size: .72rem;
  color: #999;
  font-weight: 500;
  margin-bottom: .25rem;
}

.dc-value {
  font-size: 1.8rem;
  font-weight: 800;
  color: #111;
  line-height: 1;
}

.dc-value-sm { font-size: 1.25rem; }

/* ── Mid grid ── */
.dash-mid {
  display: grid;
  grid-template-columns: 240px 240px 1fr;
  gap: 1.4rem;
  margin-bottom: 1.4rem;
  align-items: start;
}

.dash-panel {
  background: white;
  border-radius: 16px;
  padding: 1.4rem;
  box-shadow: 0 1px 8px rgba(0,0,0,.06);
}

.dash-panel-wide { grid-column: span 1; }
.dash-mt { margin-top: 0; }

.dp-titulo {
  font-size: .95rem;
  font-weight: 700;
  color: #111;
  margin: 0 0 1rem;
  display: flex;
  align-items: center;
  gap: .4rem;
}

.dp-titulo i { color: var(--primaria); }

.dp-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.dp-ver-todas {
  font-size: .8rem;
  color: var(--secundaria);
  text-decoration: none;
  font-weight: 600;
}

.dp-ver-todas:hover { color: var(--primaria); }

/* Charts */
.chart-wrap {
  position: relative;
  width: 160px;
  margin: 0 auto 1rem;
}

.chart-legenda {
  text-align: center;
  font-size: .75rem;
  color: #666;
  line-height: 2;
}

.leg-dot {
  display: inline-block;
  width: 9px; height: 9px;
  border-radius: 50%;
  vertical-align: middle;
}

/* Clientes ativos */
.cli-row {
  display: flex;
  align-items: center;
  gap: .8rem;
  padding: .65rem 0;
  border-bottom: 1px solid #f5f5f5;
}

.cli-row:last-child { border-bottom: none; }

.cli-avatar {
  width: 34px; height: 34px;
  background: var(--bege);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: .85rem;
  font-weight: 700;
  color: var(--primaria);
  flex-shrink: 0;
}

.cli-info { flex: 1; min-width: 0; }

.cli-nome {
  display: block;
  font-size: .87rem;
  font-weight: 600;
  color: #111;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.cli-sub {
  display: block;
  font-size: .73rem;
  color: #bbb;
}

.cli-badge {
  background: #e8f7ef;
  color: #16a34a;
  font-size: .7rem;
  font-weight: 700;
  padding: .2rem .65rem;
  border-radius: 20px;
  flex-shrink: 0;
}

/* Tabela */
.dash-table {
  width: 100%;
  border-collapse: collapse;
  font-size: .88rem;
}

.dash-table thead th {
  text-align: left;
  padding: .6rem 1rem;
  font-size: .72rem;
  font-weight: 700;
  color: #bbb;
  letter-spacing: .8px;
  text-transform: uppercase;
  border-bottom: 1px solid #f0f0f0;
}

.dash-table tbody td {
  padding: .8rem 1rem;
  color: #333;
  border-bottom: 1px solid #fafafa;
}

.dash-table tbody tr:last-child td { border-bottom: none; }
.dash-table tbody tr:hover td { background: #fdf9f7; }

.tb-badge {
  padding: .2rem .7rem;
  border-radius: 20px;
  font-size: .75rem;
  font-weight: 600;
}

.tb-link {
  color: #ccc;
  text-decoration: none;
  font-size: 1rem;
  transition: color .2s;
}

.tb-link:hover { color: var(--primaria); }

.dash-vazio {
  text-align: center;
  color: #ccc;
  padding: 2rem;
  font-size: .9rem;
}

/* Responsivo */
@media (max-width: 900px) {
  .dash-mid { grid-template-columns: 1fr 1fr; }
  .dash-panel-wide { grid-column: span 2; }
}

@media (max-width: 600px) {
  .dash { padding: 5rem 1rem 3rem; }
  .dash-mid { grid-template-columns: 1fr; }
  .dash-panel-wide { grid-column: span 1; }
  .dash-cards { grid-template-columns: repeat(2, 1fr); }
  .dash-table thead th:nth-child(2),
  .dash-table thead th:nth-child(3),
  .dash-table tbody td:nth-child(2),
  .dash-table tbody td:nth-child(3) { display: none; }
}
</style>

@endsection