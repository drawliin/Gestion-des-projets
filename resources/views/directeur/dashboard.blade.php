<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>
@extends('layouts.nav')

@section('title', 'Dashboard - Suivi des projets')

@section('content')
<style>
    /* Style simple et responsive */
  .dashboard {
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 15px;
  }
  .cards {
    display: flex;
    gap: 50px;
    margin-bottom: 30px;
    justify-content: center;
    flex-wrap: wrap;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .card {
    position: relative;
    flex: 1 1 220px;
    max-width: 300px;
    height: 170px;
    background: linear-gradient(135deg, #fefcea, #c2c2ba);
    border-radius: 18px;
    padding: 15px 25px 35px 25px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    text-align: center;
    transition: box-shadow 0.35s ease, transform 0.35s ease;
    cursor: default;
    color: #222;
    overflow: hidden;
  }

  .card:hover {
    box-shadow: 0 15px 30px rgba(0,0,0,0.25);
    transform: translateY(-8px);
  }

  .card .icon {
    position: absolute;
    top: 18px;
    left: 18px;
    font-size: 3rem;
    opacity: 0.20;
    color: currentColor;
    pointer-events: none;
    user-select: none;
  }

  .card h3 {
    margin-bottom: 10px;

    font-size: 1.2rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    text-shadow: 0 1px 2px rgba(0,0,0,0.05);
  }

  .card p {
    font-size: 2rem;
    font-weight: 500;
    color: #222;
    margin: 0;
    letter-spacing: 0.03em;
    text-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }

  /* Couleurs des bordures et icônes */
  .card:nth-child(1) {
    border-left: 8px solid #141413;
    color: #007bff;
  }
  .card:nth-child(1) .icon {
    color: #363636;
  }

  .card:nth-child(2) {
    border-left: 8px solid #090909;

  }
  .card:nth-child(2) .icon {
    color: #454545;
  }

  .card:nth-child(3) {
    border-left: 8px solid #0f0f0f;

  }
  .card:nth-child(3) .icon {
    color: #414140;
  }

  .card:nth-child(4) {
    border-left: 8px solid #080808;

  }
  .card:nth-child(4) .icon {
    color: #252424;
  }

  .double-donut-container {
    background: #fff;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    text-align: center;
  }

  .donuts {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }
    .donut-item {
      flex: 1 1 45%;
      max-width: 45%;
      margin: 1rem 0;
    }
    .chart-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    padding: 20px;
    margin-bottom: 2rem;
  }
  .pagination nav > div {

    justify-content: center;
    gap: 0.5rem;
    font-weight: 600;
  }

  .pagination nav a,
  .pagination nav span {
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    border: 1px solid transparent;
    cursor: pointer;
  }


  .pagination nav a {
    color:#ffb800; /* blue-500 */
    border-color: #ffb800;
    transition: background-color 0.2s, color 0.2s;
  }

  .pagination nav a:hover {
    background-color: #ffb800;
    color: white;
  }

  .pagination nav span[aria-current="page"] {
    background-color: #eaecf1; /* blue-600 */
    color: white;
    border-color: #111213;
    cursor: default;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .cards {
      flex-direction: column;
      align-items: center;
    }
    .card {
      max-width: 90%;
      margin-bottom: 20px;
    }
  }

    /* Graph containers */
    .charts {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-bottom: 40px;
    }
    .chart-card {
      flex: 1 1 450px;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 1px 5px rgb(0 0 0 / 0.1);
    }

    /* Responsive tables */
    @media (max-width: 768px) {
      .cards, .charts {
        flex-direction: column;
      }
      .card, .chart-card {
        flex: 1 1 100%;
      }
    }
</style>


    <div class="main-content">
        <div class="form-container">
        <div class="form-header">
    </div>
    <div class="form-content">
        <div class="form-title">
          <h1>Dashboard - Suivi d'avancement des projets/sous-projets</h1>
          <div class="dashboard">
            <div class="cards">
              <div class="card">
                <i class="fa-solid fa-folder-open icon"></i>
                <h3>Total Projets</h3>
                <p>{{ $totalProjets }}</p>
              </div>
              <div class="card">
                <i class="fa-solid fa-project-diagram icon"></i>
                <h3>Total Sous-Projets</h3>
                <p>{{ $totalSousProjets }}</p>
              </div>
              <div class="card">
                <i class="fa-solid fa-tachometer-alt icon"></i>
                <h3>Moyenne Avancement Physique</h3>
                <p>{{ number_format($avgPhysique, 2) }}%</p>
              </div>
              <div class="card">
                <i class="fa-solid fa-dollar-sign icon"></i>
                <h3>Moyenne Avancement Financier</h3>
                <p>{{ number_format($avgFinancier, 2) }}%</p>
              </div>
            </div>
          </div>

        </div>

  {{-- Graphiques --}}
  <div class="charts">
    <!-- Donut Charts for Projets & Sous-Projets -->
    <div class="chart-card">
    <h3>Répartition des projets</h3>
    <div class="donuts">
        <div class="donut-item">
            <h4>Par année</h4>
            <canvas id="donutProjetAnnee"></canvas>
        </div>
        <div class="donut-item">
            <h4>Par province</h4>
            <canvas id="donutProjetProvince"></canvas>
        </div>
    </div>
</div>

    <div class="chart-card">
        <h3 style="margin-bottom: 1rem; font-weight: bold; text-align: center;">Avancement moyen (%)</h3>
        <canvas id="barChart" style="max-height: 300px;"></canvas>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

  const anneeLabels = {!! json_encode($projetsParAnnee->pluck('annee')) !!};
  const anneeData = {!! json_encode($projetsParAnnee->pluck('total')) !!};

  new Chart(document.getElementById('donutProjetAnnee'), {
    type: 'doughnut',
    data: {
      labels: anneeLabels,
      datasets: [{
        data: anneeData,
        backgroundColor: ['#f94144', '#f3722c', '#f8961e', '#f9c74f', '#90be6d'],
        borderColor: '#fff',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: { font: { size: 12 } }
        }
      }
    }
  });

  // Donut Chart - Répartition par province
  const provinceLabels = {!! json_encode($projetsParProvince->pluck('province')) !!};
  const provinceData = {!! json_encode($projetsParProvince->pluck('total')) !!};

  new Chart(document.getElementById('donutProjetProvince'), {
    type: 'doughnut',
    data: {
      labels: provinceLabels,
      datasets: [{
        data: provinceData,
        backgroundColor: ['#43aa8b', '#577590', '#f9c74f', '#f9844a', '#f8961e'],
        borderColor: '#fff',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: { font: { size: 12 } }
        }
      }
    }
  });
</script>
<script>
  const barCtx = document.getElementById('barChart').getContext('2d');

  const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: ['Physique', 'Financier'],
      datasets: [{
        label: 'Avancement moyen',
        data: [
          {{ number_format($avgPhysique ?? 0, 2) }},
          {{ number_format($avgFinancier ?? 0, 2) }}
        ],
        backgroundColor: ['#4e73df', '#1cc88a'],
        borderRadius: 10,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          max: 100,
          ticks: {
            stepSize: 10
          },
          title: {
            display: true,
            text: '%',
            font: { size: 14 }
          }
        }
      },
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.parsed.y + '%';
            }
          }
        },
        title: {
          display: false
        }
      }
    }
  });
</script>

@endsection
