<x-admin-layout title="Dashboard">
<style>
    :root {
        --primary-color: #00bc84;
        --primary-light: #00d194;
        --primary-dark: #00a374;
        --secondary-color: #f8f9fa;
        --text-dark: #2d3748;
        --text-light: #718096;
        --border-color: #e2e8f0;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: #f7fafc;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
.stat-card-enhanced {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    overflow: hidden;
    height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.stat-card-enhanced:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}
  .dashboard-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    color: #ffffff; /* Putih solid, bukan 'white' */
    padding: 2rem 0;
    margin-bottom: 2rem;
    border-radius: 0 0 1rem 1rem;
}
.dashboard-header h1 {
    color: #ffffff !important;
}

.dashboard-header p {
    color: #ffffff !important;
    opacity: 1 !important;
}
.stat-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
}

.decoration-circle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    animation: float 6s ease-in-out infinite;
}

.decoration-1 {
    width: 60px;
    height: 60px;
    top: -30px;
    right: -30px;
    animation-delay: 0s;
}

.decoration-2 {
    width: 40px;
    height: 40px;
    top: 20px;
    right: 80px;
    animation-delay: 2s;
}

.decoration-3 {
    width: 80px;
    height: 80px;
    top: 60px;
    right: -20px;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(5deg); }
}


.stat-content {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    position: relative;
    z-index: 2;
}

.stat-icon-enhanced {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    position: relative;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    flex-shrink: 0;
}

.icon-glow {
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    border-radius: 20px;
    opacity: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.3), transparent);
    transition: opacity 0.3s ease;
}

.stat-card-enhanced:hover .icon-glow {
    opacity: 1;
}

.stat-details {
    flex: 1;
}

.stat-value-enhanced {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, var(--text-dark) 0%, #4a5568 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
}

.stat-label-enhanced {
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.stat-sublabel {
    color: var(--text-light);
    font-size: 0.85rem;
    font-weight: 400;
}


.stat-trend {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1rem;
    position: relative;
    z-index: 2;
}

.trend-line {
    flex: 1;
    height: 3px;
    border-radius: 2px;
    background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-light) 100%);
    margin-right: 1rem;
    position: relative;
    overflow: hidden;
}

.trend-line.trend-up::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

.trend-text {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-light);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}



    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .chart-container {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
        margin-bottom: 2rem;
        position: relative;
        height: auto;
    }

    .chart-container canvas {
        max-height: 350px !important;
        height: 300px !important;
    }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .progress-bar {
        height: 8px;
        border-radius: 4px;
        background-color: #e2e8f0;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-light) 100%);
        transition: width 0.3s ease;
    }

    .service-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .service-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        text-decoration: none;
        color: inherit;
    }

    .service-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .service-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
    }

    .trend-indicator {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .trend-up {
        color: #10b981;
    }

    .trend-down {
        color: #ef4444;
    }

    .table-responsive {
        background: white;
        border-radius: 12px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border-color);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        border-top: none;
        border-bottom: 2px solid var(--border-color);
        font-weight: 600;
        color: var(--text-dark);
        padding: 1rem;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-color: var(--border-color);
    }

    .badge {
        font-size: 0.75rem;
        font-weight: 500;
        padding: 0.375rem 0.75rem;
    }

    .badge-success {
        background-color: #10b981;
        color: white;
    }

    .badge-warning {
        background-color: #f59e0b;
        color: white;
    }

    .badge-danger {
        background-color: #ef4444;
        color: white;
    }

    .real-time-indicator {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .pulse {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #10b981;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1rem 0;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
        
        .chart-container {
            padding: 1rem;
        }
    }
  
/* DateTime Display Styling */
/* DateTime Display Styling */
.datetime-display {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 1.2rem 1.5rem;
    text-align: right;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    color: #ffffff !important; /* Paksa semua teks di dalam datetime-display menjadi putih */
}

.datetime-display:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    color: #ffffff !important; /* Paksa tetap putih saat hover */
}

.date-display, .time-display {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.5rem;
    color: #ffffff !important; /* Paksa warna putih solid */
    font-weight: 500;
}

.date-display {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    opacity: 1 !important; /* Paksa opacity penuh untuk warna solid */
}

.time-display {
    font-size: 1.3rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.date-display i, .time-display i {
    font-size: 1rem;
    opacity: 1 !important; /* Paksa opacity penuh untuk icon solid */
    color: #ffffff !important; /* Paksa warna putih solid untuk icon */
}

.time-display i {
    font-size: 1.2rem;
    color: #ffffff !important; /* Paksa warna putih solid untuk icon waktu */
}

/* Paksa semua elemen teks dan span di dalam datetime menjadi putih */
.datetime-display * {
    color: #ffffff !important;
}

.datetime-display span {
    color: #ffffff !important;
}
@media (max-width: 768px) {
    .datetime-display {
        margin-top: 1rem;
        text-align: center;
        padding: 1rem;
    }
    
    .date-display, .time-display {
        justify-content: center;
        color: #ffffff !important; /* Pastikan warna putih solid di mobile */
    }
    
    .time-display {
        font-size: 1.1rem;
    }
}

/* Dashboard header existing styles */
.dashboard-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
    color: #ffffff;
    padding: 2rem 0;
    margin-bottom: 2rem;
    border-radius: 0 0 1rem 1rem;
}

.dashboard-header h1 {
    color: #ffffff !important;
    font-weight: 700;
}

.dashboard-header p {
    color: #ffffff !important;
    opacity: 0.9 !important;
}
</style>

<div class="dashboard-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">Dashboard Klinik Marchsya</h1>
                <p class="mb-0 opacity-75">Selamat datang kembali, Super Admin. Berikut ringkasan aktivitas klinik hari ini.</p>
            </div>
            <div class="col-md-4">
                <div class="datetime-display">
                    <div class="date-display">
                        <i class="fas fa-calendar-alt"></i>
                        <span id="currentDate">Loading...</span>
                    </div>
                    <div class="time-display">
                        <i class="fas fa-clock"></i>
                        <span id="currentTime">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Quick Stats -->
    <div class="row mb-4">
    <div class="col-lg-6 col-md-6 mb-4">
        <div class="stat-card-enhanced">
            <div class="stat-decoration">
                <div class="decoration-circle decoration-1"></div>
                <div class="decoration-circle decoration-2"></div>
                <div class="decoration-circle decoration-3"></div>
            </div>
            <div class="stat-content">
                <div class="stat-icon-enhanced" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-users text-white"></i>
                    <div class="icon-glow"></div>
                </div>
                <div class="stat-details">
                    <div class="stat-value-enhanced">{{ number_format($statistics['total_pasien']) }}</div>
                    <div class="stat-label-enhanced">Total Pasien Terdaftar</div>
                    <div class="stat-sublabel">Seluruh pasien yang terdaftar di sistem</div>
                </div>
            </div>
            <div class="stat-trend">
                <div class="trend-line"></div>
                <span class="trend-text">
                    <i class="fas fa-chart-line text-success"></i>
                    Stabil
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 col-md-6 mb-4">
        <div class="stat-card-enhanced">
            <div class="stat-decoration">
                <div class="decoration-circle decoration-1"></div>
                <div class="decoration-circle decoration-2"></div>
                <div class="decoration-circle decoration-3"></div>
            </div>
            <div class="stat-content">
                <div class="stat-icon-enhanced" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);">
                    <i class="fas fa-heartbeat text-white"></i>
                    <div class="icon-glow"></div>
                </div>
                <div class="stat-details">
                    <div class="stat-value-enhanced">{{ number_format($statistics['pemeriksaan_umum'] + $statistics['laboratorium'] + $statistics['radiologi']) }}</div>
                    <div class="stat-label-enhanced">Total Semua Pemeriksaan</div>
                    <div class="stat-sublabel">Pemeriksaan Umum, Laboratorium & Radiologi</div>
                </div>
            </div>
            <div class="stat-trend">
                <div class="trend-line trend-up"></div>

            </div>
        </div>
    </div>
</div>

    <!-- Service Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('admin.pemeriksaanumum.index') }}" class="service-card">
                <div class="service-header">
                    <div class="service-icon" style="background: var(--primary-color);">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                   
                </div>
                <h5 class="mb-3">Pemeriksaan Umum</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $statistics['pemeriksaan_umum'] }}</div>
                        <div class="stat-label">Total Pasien</div>
                    </div>
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $dashboardData['pemeriksaan_hari_ini']['pemeriksaan_umum']['total'] }}</div>
                        <div class="stat-label">Hari Ini</div>
                    </div>
                </div>
                <div class="progress-bar mt-3">
                    <div class="progress-fill" style="width: {{ $dashboardData['pemeriksaan_hari_ini']['pemeriksaan_umum']['total'] > 0 ? ($dashboardData['pemeriksaan_hari_ini']['pemeriksaan_umum']['selesai'] / $dashboardData['pemeriksaan_hari_ini']['pemeriksaan_umum']['total']) * 100 : 0 }}%"></div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('admin.laboratorium.index') }}" class="service-card">
                <div class="service-header">
                    <div class="service-icon" style="background: #f59e0b;">
                        <i class="fas fa-flask"></i>
                    </div>
                    
                </div>
                <h5 class="mb-3">Laboratorium</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $statistics['laboratorium'] }}</div>
                        <div class="stat-label">Total Pasien</div>
                    </div>
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $dashboardData['pemeriksaan_hari_ini']['laboratorium']['total'] }}</div>
                        <div class="stat-label">Hari Ini</div>
                    </div>
                </div>
               <div class="progress-bar mt-3">
    <div class="progress-fill" style="width: {{ $dashboardData['pemeriksaan_hari_ini']['laboratorium']['total'] > 0 ? 100 : 0 }}%; background: #f59e0b;"></div>
</div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('admin.radiologi.index') }}" class="service-card">
                <div class="service-header">
                    <div class="service-icon" style="background: #8b5cf6;">
                        <i class="fas fa-x-ray"></i>
                    </div>
                   
                </div>
                <h5 class="mb-3">Radiologi</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $statistics['radiologi'] }}</div>
                        <div class="stat-label">Total Pasien</div>
                    </div>
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $dashboardData['pemeriksaan_hari_ini']['radiologi']['total'] }}</div>
                        <div class="stat-label">Hari Ini</div>
                    </div>
                </div>
          <div class="progress-bar mt-3">
                    <div class="progress-fill" style="width: {{ $dashboardData['pemeriksaan_hari_ini']['radiologi']['total'] > 0 ? ($dashboardData['pemeriksaan_hari_ini']['radiologi']['selesai'] / $dashboardData['pemeriksaan_hari_ini']['radiologi']['total']) * 100 : 0 }}%; background: #8b5cf6;"></div>
                </div>
            </a>
        </div>
                
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('admin.pendaftaran.index') }}" class="service-card">
                <div class="service-header">
                    <div class="service-icon" style="background: #ef4444;">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    
                </div>
                <h5 class="mb-3">Pendaftaran</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $statistics['dikonfirmasi'] + $statistics['ditolak'] + $statistics['menunggu'] }}</div>
                        <div class="stat-label">Total</div>
                    </div>
                    <div class="col-6">
                        <div class="stat-value" style="font-size: 1.5rem;">{{ $statistics['pendaftaran_hari_ini'] }}</div>
                        <div class="stat-label">Hari Ini</div>
                    </div>
                </div>
                <div class="progress-bar mt-3">
                    <div class="progress-fill" style="width: {{ $statistics['dikonfirmasi'] + $statistics['ditolak'] + $statistics['menunggu'] > 0 ? ($statistics['dikonfirmasi'] / ($statistics['dikonfirmasi'] + $statistics['ditolak'] + $statistics['menunggu'])) * 100 : 0 }}%; background: #ef4444;"></div>
                </div>
            </a>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="chart-container">
                <div class="chart-title">
                    <i class="fas fa-chart-line text-primary"></i>
                    Tren Kunjungan 7 Hari Terakhir
                </div>
                <canvas id="weeklyTrendChart" style="height: 300px !important;"></canvas>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="chart-container">
                <div class="chart-title">
                    <i class="fas fa-chart-pie text-primary"></i>
                    Total Pemeriksaan Data
                </div>
                <canvas id="serviceDistributionChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            
   <!--  <div class="chart-container">
       <div class="chart-title">
            <i class="fas fa-chart-bar text-primary"></i>
            Statistik Pendaftaran 7 Hari Terakhir
        </div>
        <canvas id="registrationChart" height="250"></canvas>
    </div> -->

</div>
        <div class="col-lg-6 mb-4">
            <div class="chart-container">
                <div class="chart-title">
                    <i class="fas fa-users text-primary"></i>
                    Top 5 Pasien Terbanyak Kunjungan
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama Pasien</th>
                                <th>Total Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dashboardData['top_pasien'] as $pasien)
                            <tr>
                                <td>{{ $pasien->nik }}</td>
                                <td>{{ $pasien->nama }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $pasien->total_kunjungan }}x</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Queue Status -->
    
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    (function() {
    function updateTime() {
        const now = new Date();
        const date = now.toLocaleDateString('id-ID', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
        const time = now.toLocaleTimeString('id-ID');
        
        document.getElementById('currentDate').innerHTML = date;
        document.getElementById('currentTime').innerHTML = time;
    }
    
    updateTime();
    setInterval(updateTime, 1000);
})();
// Weekly Trend Chart
const weeklyCtx = document.getElementById('weeklyTrendChart').getContext('2d');
const weeklyData = @json($dashboardData['grafik_mingguan']);

new Chart(weeklyCtx, {
    type: 'line',
    data: {
        labels: weeklyData.map(item => item.tanggal),
        datasets: [
            {
                label: 'Pemeriksaan Umum',
                data: weeklyData.map(item => item.pemeriksaan_umum),
                borderColor: '#00bc84',
                backgroundColor: 'rgba(0, 188, 132, 0.1)',
                tension: 0.4,
                fill: false
            },
            {
                label: 'Laboratorium',
                data: weeklyData.map(item => item.laboratorium),
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4,
                fill: false
            },
            {
                label: 'Radiologi',
                data: weeklyData.map(item => item.radiologi),
                borderColor: '#8b5cf6',
                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                tension: 0.4,
                fill: false
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            intersect: false,
        },
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#e2e8f0'
                },
                ticks: {
                    stepSize: 1
                }
            },
            x: {
                grid: {
                    color: '#e2e8f0'
                }
            }
        }
    }
});

// Service Distribution Chart (Pie)
// Service Distribution Chart (Pie) - Total Data
const serviceCtx = document.getElementById('serviceDistributionChart').getContext('2d');

new Chart(serviceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Pemeriksaan Umum', 'Laboratorium', 'Radiologi'],
        datasets: [{
            data: [
                {{ $statistics['pemeriksaan_umum'] }},
                {{ $statistics['laboratorium'] }},
                {{ $statistics['radiologi'] }}
            ],
            backgroundColor: ['#00bc84', '#f59e0b', '#8b5cf6'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});

// Exam Status Chart (Bar)
const registrationCtx = document.getElementById('registrationChart').getContext('2d');
const registrationData = @json($dashboardData['pendaftaran_7_hari']); // Data dari controller

new Chart(registrationCtx, {
    type: 'bar',
    data: {
        labels: registrationData.map(item => item.tanggal), // ['Sen', 'Sel', 'Rab', ...]
        datasets: [{
            label: 'Jumlah Pendaftaran',
            data: registrationData.map(item => item.total),
            backgroundColor: '#00bc84',
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#e2e8f0'
                },
                ticks: {
                    stepSize: 1
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Real-time data update (optional - uncomment if route is available)
/*
function updateRealTimeData() {
    fetch('/admin/real-time-data') // Adjust URL as needed
        .then(response => response.json())
        .then(data => {
            // Update any real-time elements here
            console.log('Real-time data updated:', data);
        })
        .catch(error => console.error('Error fetching real-time data:', error));
}

// Update every 30 seconds
setInterval(updateRealTimeData, 30000);
*/

// Simple page refresh alternative (every 5 minutes)
setInterval(function() {
    // You can uncomment this if you want auto-refresh
    // location.reload();
}, 300000);
</script>
</x-admin-layout>