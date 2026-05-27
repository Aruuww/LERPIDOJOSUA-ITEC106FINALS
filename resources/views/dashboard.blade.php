@extends('layouts.app')
@section('page-title', 'Dashboard')

@section('content')

{{-- Welcome Banner --}}
<div class="welcome-banner mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <div class="welcome-greeting">Welcome back,</div>
            <div class="welcome-name">{{ auth()->user()->name }}</div>
        </div>
        <div class="banner-crest">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 110" width="70" height="70" opacity="0.15">
                <path d="M50 4 L88 18 L88 58 Q88 84 50 98 Q12 84 12 58 L12 18 Z" fill="#fff" stroke="#fff" stroke-width="2"/>
                <path d="M50 4 L12 18 L12 54 L50 54 Z" fill="#fff"/>
                <path d="M50 4 L88 18 L88 54 L50 54 Z" fill="#fff"/>
                <line x1="50" y1="4" x2="50" y2="98" stroke="#1a1a1a" stroke-width="2"/>
                <line x1="12" y1="54" x2="88" y2="54" stroke="#1a1a1a" stroke-width="2"/>
            </svg>
        </div>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-4">
        <div class="kpi-card kpi-red">
            <div class="kpi-icon"><i class="bi bi-people-fill"></i></div>
            <div class="kpi-body">
                <div class="kpi-value">{{ $totalUsers }}</div>
                <div class="kpi-label">Total Users</div>
            </div>
            <div class="kpi-bg-icon"><i class="bi bi-people-fill"></i></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="kpi-card kpi-gold">
            <div class="kpi-icon"><i class="bi bi-car-front-fill"></i></div>
            <div class="kpi-body">
                <div class="kpi-value">{{ $totalVehicles }}</div>
                <div class="kpi-label">Total Vehicles</div>
            </div>
            <div class="kpi-bg-icon"><i class="bi bi-car-front-fill"></i></div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="kpi-card kpi-dark">
            <div class="kpi-icon"><i class="bi bi-person-check-fill"></i></div>
            <div class="kpi-body">
                <div class="kpi-value">{{ $myVehicles }}</div>
                <div class="kpi-label">My Vehicles</div>
            </div>
            <div class="kpi-bg-icon"><i class="bi bi-person-check-fill"></i></div>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="row g-3">
    <div class="col-lg-7">
        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <div class="chart-title">Vehicles Registered</div>
                    <div class="chart-sub">Monthly overview for {{ date('Y') }}</div>
                </div>
                <span class="chart-badge"><i class="bi bi-bar-chart-fill me-1"></i>Bar</span>
            </div>
            <div class="chart-card-body">
                <canvas id="monthlyChart" height="110"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="chart-card">
            <div class="chart-card-header">
                <div>
                    <div class="chart-title">Vehicles by Type</div>
                    <div class="chart-sub">Distribution across categories</div>
                </div>
                <span class="chart-badge"><i class="bi bi-pie-chart-fill me-1"></i>Donut</span>
            </div>
            <div class="chart-card-body d-flex justify-content-center align-items-center">
                <canvas id="typeChart" height="170" style="max-width:270px;"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, var(--porsche-dark) 0%, #2c1a1a 100%);
        border-radius: 12px;
        padding: 1.5rem 2rem;
        position: relative;
        overflow: hidden;
        border-left: 4px solid var(--porsche-red);
    }
    .welcome-greeting { color: #aaa; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; }
    .welcome-name { color: #fff; font-size: 1.6rem; font-weight: 800; letter-spacing: 1px; line-height: 1.2; }
    .welcome-sub { color: #888; font-size: 0.82rem; margin-top: 0.25rem; }
    .banner-crest { position: absolute; right: 2rem; top: 50%; transform: translateY(-50%); }

    /* KPI Cards */
    .kpi-card {
        border-radius: 12px;
        padding: 1.4rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    }
    .kpi-red  { background: linear-gradient(135deg, #D5001C, #a0001a); }
    .kpi-gold { background: linear-gradient(135deg, #c9a84c, #a07830); }
    .kpi-dark { background: linear-gradient(135deg, #2c2c2c, #1a1a1a); }

    .kpi-icon {
        width: 52px; height: 52px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: #fff;
        flex-shrink: 0; z-index: 1;
    }
    .kpi-body { z-index: 1; }
    .kpi-value { font-size: 2rem; font-weight: 800; color: #fff; line-height: 1; }
    .kpi-label { font-size: 0.72rem; color: rgba(255,255,255,0.75); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 0.2rem; }
    .kpi-bg-icon {
        position: absolute; right: -10px; bottom: -10px;
        font-size: 5rem; color: rgba(255,255,255,0.07);
        line-height: 1;
    }

    /* Chart Cards */
    .chart-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        overflow: hidden;
        height: 100%;
    }
    .chart-card-header {
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .chart-title { font-weight: 700; font-size: 0.95rem; color: var(--porsche-dark); }
    .chart-sub { font-size: 0.72rem; color: #aaa; margin-top: 1px; }
    .chart-badge {
        background: #f5f5f5;
        color: #888;
        font-size: 0.7rem;
        padding: 0.3em 0.75em;
        border-radius: 20px;
        font-weight: 600;
        white-space: nowrap;
    }
    .chart-card-body { padding: 1.25rem 1.4rem; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
const red  = '#D5001C';
const gold = '#c9a84c';

new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Vehicles',
            data: @json($counts),
            backgroundColor: red,
            borderRadius: 5,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f5f5f5' } },
            x: { grid: { display: false } }
        }
    }
});

const typeLabels = @json($vehicleTypes->keys());
const typeData   = @json($vehicleTypes->values());
const colors     = [red, gold, '#4a6cf7', '#28a745', '#fd7e14', '#6f42c1'];

new Chart(document.getElementById('typeChart'), {
    type: 'doughnut',
    data: {
        labels: typeLabels.length ? typeLabels : ['No Data'],
        datasets: [{
            data: typeData.length ? typeData : [1],
            backgroundColor: typeLabels.length ? colors : ['#e0e0e0'],
            borderWidth: 2,
            borderColor: '#fff',
        }]
    },
    options: {
        cutout: '65%',
        plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } } }
    }
});
</script>
@endpush
