<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* --- General Improvements --- */
body {
    background: #f6f7fb;
    color: #222;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
}

.dashboard {
    max-width: 1200px;
    margin: 30px auto;
    padding: 0 15px;
}

/* --- Cards --- */
.cards {
    display: flex;
    gap: 30px;
    margin-bottom: 30px;
    justify-content: center;
    flex-wrap: wrap;
}

.card {
    position: relative;
    flex: 1 1 220px;
    max-width: 260px;
    min-width: 200px;
    height: 160px;
    background: linear-gradient(135deg, #fefcea 60%, #e9e9e3 100%);
    border-radius: 18px;
    padding: 18px 25px 35px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.10);
    text-align: center;
    transition: box-shadow 0.25s, transform 0.25s;
    cursor: default;
    color: #222;
    overflow: hidden;
    border-left: 6px solid #007bff;
}

.card:hover {
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.18);
    transform: translateY(-6px) scale(1.03);
}

.card .icon {
    position: absolute;
    top: 18px;
    left: 18px;
    font-size: 2.8rem;
    opacity: 0.18;
    color: #007bff;
    pointer-events: none;
    user-select: none;
}

.card h3 {
    margin-bottom: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #333;
}

.card p {
    font-size: 2.1rem;
    font-weight: 700;
    color: #222;
    margin: 0;
    letter-spacing: 0.03em;
}

/* --- Charts --- */
.charts {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    margin-bottom: 40px;
    justify-content: center;
}

.chart-card {
    flex: 1 1 420px;
    background: #fff;
    padding: 32px 24px 24px 24px;
    border-radius: 16px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.08);
    min-width: 320px;
    margin-bottom: 20px;
    transition: box-shadow 0.2s;
}

.chart-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.13);
}

.chart-card canvas {
    display: block;
    margin: 0 auto;
    width: 100% !important;
    max-width: 350px;
    height: 260px !important;
}

.chart-card h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #007bff;
    margin-bottom: 18px;
    text-align: center;
    letter-spacing: 0.02em;
}

.donuts {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
}
.donut-item {
    box-shadow: 0 1px 6px rgba(0,0,0,0.06);
    border: 1px solid #f0f0f0;
    margin: 1rem 0;
    background: #f8f9fa;
    border-radius: 10px;
    padding: 18px 0 10px 0;
}

/* --- Pagination --- */
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
    color: #007bff;
    border-color: #007bff;
    transition: background-color 0.2s, color 0.2s;
}

.pagination nav a:hover {
    background-color: #007bff;
    color: white;
}

.pagination nav span[aria-current="page"] {
    background-color: #eaecf1;
    color: #007bff;
    border-color: #007bff;
    cursor: default;
}

/* --- Responsive --- */
@media (max-width: 900px) {
    .cards, .charts {
        flex-direction: column;
        align-items: center;
    }
    .card, .chart-card {
        flex: 1 1 100%;
        max-width: 95%;
        margin-bottom: 20px;
    }
    .donuts {
        flex-direction: column;
        gap: 10px;
    }
    .donut-item {
        max-width: 100%;
    }
}

@media (max-width: 600px) {
    .chart-card {
        min-width: 0;
        padding: 12px 4px;
    }
    .chart-card canvas {
        max-width: 98vw;
        height: 180px !important;
    }
}
</style>
</head>
@extends('layouts.nav')

@section('title', 'Dashboard - Suivi des projets')

@section('content')



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
