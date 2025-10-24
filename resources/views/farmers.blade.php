{{--@dd($member->policies[0])--}}
<x-master>
    <section class="pc-container">
        <div class="pc-content">
            <style>
                :root {
                    --primary-green: #137a2a;
                    --success-green: #2fa84f;
                    --light-green: #7bd389;
                    --pale-green: #bdeec6;
                    --bg-green: #edf9f4;
                }

                .dashboard-header {
                    background: linear-gradient(135deg, var(--primary-green) 0%, var(--success-green) 100%);
                    color: white;
                    padding: 2rem;
                    border-radius: 12px;
                    margin-bottom: 2rem;
                    box-shadow: 0 8px 24px rgba(19, 122, 42, 0.2);
                    animation: fadeInDown 0.6s ease;
                }

                .dashboard-header h3 {
                    margin: 0;
                    font-weight: 600;
                    font-size: 1.8rem;
                }

                .dashboard-header p {
                    margin: 0.5rem 0 0 0;
                    opacity: 0.9;
                    font-size: 1rem;
                }

                .stat-card {
                    border: none;
                    border-radius: 12px;
                    padding: 1.5rem;
                    margin-bottom: 1.5rem;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                    animation: fadeInUp 0.6s ease;
                    position: relative;
                    overflow: hidden;
                }

                .stat-card::before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 4px;
                    height: 100%;
                    transition: width 0.3s ease;
                }

                .stat-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
                }

                .stat-card:hover::before {
                    width: 100%;
                    opacity: 0.1;
                }

                .stat-card-primary {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                }

                .stat-card-primary::before {
                    background: #667eea;
                }

                .stat-card-success {
                    background: linear-gradient(135deg, var(--success-green) 0%, var(--primary-green) 100%);
                    color: white;
                }

                .stat-card-success::before {
                    background: var(--success-green);
                }

                .stat-card-info {
                    background: linear-gradient(135deg, #56ccf2 0%, #2f80ed 100%);
                    color: white;
                }

                .stat-card-info::before {
                    background: #56ccf2;
                }

                .stat-card .card-icon {
                    font-size: 2.5rem;
                    opacity: 0.3;
                    position: absolute;
                    right: 1rem;
                    top: 50%;
                    transform: translateY(-50%);
                }

                .stat-card .card-title {
                    font-size: 0.95rem;
                    font-weight: 500;
                    margin-bottom: 0.5rem;
                    opacity: 0.9;
                }

                .stat-card .card-value {
                    font-size: 2.5rem;
                    font-weight: 700;
                    margin: 0;
                }

                .dashboard-bg {
                    background: linear-gradient(135deg, rgba(237, 249, 244, 0.6) 0%, rgba(190, 238, 198, 0.4) 100%),
                    url('{{ asset("images/livestock-bg.jpg") }}');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    position: relative;
                    border-radius: 12px;
                    padding: 2rem 0;
                    margin-top: 2rem;
                }

                .dashboard-bg::after {
                    content: "";
                    position: absolute;
                    inset: 0;
                    background: rgba(255,255,255,0.9);
                    pointer-events: none;
                    border-radius: 12px;
                }

                .charts-container {
                    position: relative;
                    z-index: 1;
                    padding: 0 1.5rem;
                }

                .chart-card {
                    background: white;
                    border: none;
                    border-radius: 12px;
                    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
                    transition: all 0.3s ease;
                    animation: fadeInUp 0.8s ease;
                    overflow: hidden;
                }

                .chart-card:hover {
                    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
                    transform: translateY(-4px);
                }

                .chart-card .card-body {
                    padding: 1.25rem;
                }

                .chart-card .card-title {
                    color: var(--primary-green);
                    font-weight: 600;
                    font-size: 1rem;
                    margin-bottom: 0.75rem;
                    padding-bottom: 0.5rem;
                    border-bottom: 2px solid var(--bg-green);
                }

                .chart-card canvas {
                    max-height: 280px !important;
                }

                .info-card {
                    background: white;
                    border: none;
                    border-radius: 12px;
                    padding: 1.25rem;
                    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
                    transition: all 0.3s ease;
                    animation: fadeInUp 0.9s ease;
                    text-align: center;
                    height: 100%;
                }

                .info-card:hover {
                    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
                    transform: translateY(-4px);
                }

                .info-card h6 {
                    color: var(--primary-green);
                    font-weight: 600;
                    margin-bottom: 0.75rem;
                    font-size: 0.95rem;
                }

                .info-card .metric {
                    font-size: 2rem;
                    font-weight: 700;
                    color: var(--success-green);
                    margin: 0.25rem 0;
                }

                .info-card .sub-metric {
                    font-size: 0.85rem;
                    color: #6c757d;
                    margin-top: 0.5rem;
                }

                .info-card .sub-metric strong {
                    color: var(--primary-green);
                    font-size: 1.1rem;
                }

                @keyframes fadeInDown {
                    from {
                        opacity: 0;
                        transform: translateY(-20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .stat-card:nth-child(1) { animation-delay: 0.1s; }
                .stat-card:nth-child(2) { animation-delay: 0.2s; }
                .stat-card:nth-child(3) { animation-delay: 0.3s; }

                @media (max-width: 768px) {
                    .dashboard-header h3 {
                        font-size: 1.5rem;
                    }

                    .stat-card .card-value {
                        font-size: 2rem;
                    }

                    .dashboard-bg {
                        background-attachment: scroll;
                    }
                }
            </style>

            <div class="mt-4">
                <div class="dashboard-header">
                    <h3>👋 Welcome back, {{ auth()->user()->name }}!</h3>
                    <p>Here's an overview of your farm operations today</p>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card stat-card-primary">
                            <span class="card-icon">🐄</span>
                            <h5 class="card-title">My Livestock</h5>
                            <p class="card-value">{{ number_format($totalLivestock) }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card stat-card-success">
                            <span class="card-icon">💉</span>
                            <h5 class="card-title"> Vaccinations</h5>
                            <p class="card-value">{{ number_format($missedVaccinations) }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card stat-card-info">
                            <span class="card-icon">⚠️</span>
                            <h5 class="card-title">Active Disease Alerts</h5>
                            <p class="card-value">{{ number_format($activeAlerts) }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-4 dashboard-bg">
                    <div class="col-12 charts-container">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="chart-card">
                                    <div class="card-body">
                                        <h6 class="card-title">🦠 Common Diseases Affecting My Livestock</h6>
                                        <canvas id="diseasesChart" height="180"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="chart-card">
                                    <div class="card-body">
                                        <h6 class="card-title">🐑 My Livestock by Species</h6>
                                        <canvas id="livestockChart" height="180"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="chart-card">
                                    <div class="card-body">
                                        <h6 class="card-title">📈 My Livestock Growth Over Time</h6>
                                        <canvas id="registrationsChart" height="160"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="info-card">
                                            <h6>📋 Health Summary</h6>
                                            <div class="metric">{{ number_format($healthyAnimals) }}</div>
                                            <div class="sub-metric">
                                                Healthy animals out of {{ number_format($totalLivestock) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="info-card">
                                            <h6>🩺 Recent Health Checks</h6>
                                            <div class="metric">{{ number_format($recentHealthRecords) }}</div>
                                            <div class="sub-metric">
                                                In the last 30 days
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const diseasesLabels = @json(array_keys($diseasesData ?? []));
        const diseasesValues = @json(array_values($diseasesData ?? []));
        const livestockLabels = @json(array_keys($livestockDistribution ?? []));
        const livestockValues = @json(array_values($livestockDistribution ?? []));
        const registrationsLabels = @json($registrationsMonths ?? []);
        const registrationsValues = @json($registrationsCounts ?? []);

        const greenPalette = ['#137a2a', '#2fa84f', '#7bd389', '#56ab6f', '#4a9d5f', '#bdeec6'];

        Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial';
        Chart.defaults.plugins.legend.labels.usePointStyle = true;
        Chart.defaults.plugins.legend.labels.padding = 10;

        new Chart(document.getElementById('diseasesChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: diseasesLabels,
                datasets: [{
                    data: diseasesValues,
                    backgroundColor: greenPalette,
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 8, font: { size: 10 } }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(19, 122, 42, 0.9)',
                        padding: 10,
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 11 }
                    }
                }
            }
        });

        new Chart(document.getElementById('livestockChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: livestockLabels,
                datasets: [{
                    data: livestockValues,
                    backgroundColor: [...greenPalette].reverse(),
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '55%',
                animation: {
                    animateScale: true,
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 8, font: { size: 10 } }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(19, 122, 42, 0.9)',
                        padding: 10,
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 11 }
                    }
                }
            }
        });

        new Chart(document.getElementById('registrationsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: registrationsLabels,
                datasets: [{
                    label: 'New Animals',
                    data: registrationsValues,
                    backgroundColor: 'rgba(19, 122, 42, 0.08)',
                    borderColor: '#137a2a',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#137a2a',
                    pointBorderWidth: 2,
                    pointHoverBackgroundColor: '#137a2a',
                    pointHoverBorderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(19, 122, 42, 0.06)',
                            drawBorder: false
                        },
                        ticks: { font: { size: 10 } }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(19, 122, 42, 0.9)',
                        padding: 10,
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 11 }
                    }
                },
                animation: {
                    duration: 1200,
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>
</x-master>
