<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laboratorium - {{ $judul_periode }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 20px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
            font-weight: bold;
        }
        
        .header h2 {
            margin: 5px 0;
            font-size: 18px;
            color: #34495e;
            font-weight: normal;
        }
        
        .header .periode {
            margin: 10px 0;
            font-size: 14px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        .generated-info {
            text-align: right;
            font-size: 10px;
            color: #95a5a6;
            margin-bottom: 20px;
        }
        
        .statistics {
            margin-bottom: 30px;
        }
        
        .stats-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            flex: 0 0 calc(50% - 7.5px);
            min-width: 0;
        }
        
        .stat-card h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #495057;
            font-weight: bold;
        }
        
        .stat-card .number {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }
        
        .stat-card.primary { border-left: 4px solid #3498db; }
        .stat-card.warning { border-left: 4px solid #f39c12; }
        .stat-card.info { border-left: 4px solid #17a2b8; }
        .stat-card.success { border-left: 4px solid #28a745; }
        .stat-card.secondary { border-left: 4px solid #6c757d; }
        .stat-card.danger { border-left: 4px solid #dc3545; }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #bdc3c7;
        }
        
        .breakdown {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .breakdown-item {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 12px;
            text-align: center;
        }
        
        .breakdown-item .label {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 5px;
        }
        
        .breakdown-item .value {
            font-size: 18px;
            font-weight: bold;
            color: #495057;
        }
        
        .dokter-stats {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .dokter-stats h4 {
            margin: 0 0 15px 0;
            font-size: 14px;
            color: #495057;
        }
        
        .dokter-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        
        .dokter-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background: white;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }
        
        .dokter-name {
            font-weight: 500;
            color: #495057;
        }
        
        .dokter-count {
            background: #e9ecef;
            color: #495057;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }
        
        .data-table th,
        .data-table td {
            border: 1px solid #dee2e6;
            padding: 8px 6px;
            text-align: left;
            vertical-align: top;
        }
        
        .data-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #495057;
            text-align: center;
        }
        
        .data-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .data-table tbody tr:hover {
            background-color: #e9ecef;
        }
        
        .status-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-sedang-diperiksa {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .status-selesai {
            background-color: #d4edda;
            color: #155724;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .footer {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN LABORATORIUM</h1>
        <h2>KLINIK MARCHSYA</h2>
        <div class="periode">Periode: {{ $judul_periode }}</div>
    </div>
    
    <!-- Generated Info -->
    <div class="generated-info">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }} WIB
    </div>
    
    <!-- Statistics Overview -->
    <div class="statistics">
        <div class="section-title">Ringkasan Statistik</div>
        
        <div style="width: 100%; margin-bottom: 20px;">
            <div style="display: table; width: 100%; border-spacing: 15px;">
                <div style="display: table-row;">
                    <div style="display: table-cell; width: 50%; vertical-align: top;">
                        <div class="stat-card primary">
                            <h3>Total Pemeriksaan</h3>
                            <div class="number">{{ number_format($total_laboratorium) }}</div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 50%; vertical-align: top;">
                        <div class="stat-card warning">
                            <h3>Menunggu</h3>
                            <div class="number">{{ number_format($menunggu) }}</div>
                        </div>
                    </div>
                </div>
                <div style="display: table-row;">
                    <div style="display: table-cell; width: 50%; vertical-align: top;">
                        <div class="stat-card info">
                            <h3>Sedang Diperiksa</h3>
                            <div class="number">{{ number_format($sedang_diperiksa) }}</div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 50%; vertical-align: top;">
                        <div class="stat-card success">
                            <h3>Selesai</h3>
                            <div class="number">{{ number_format($selesai) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
        <br>
    <br>
        <br>
    <br>
        <br>
            <br>
    <br>
    <br>
    <!-- Detailed Breakdown -->
    <!-- Rincian Data -->
<div class="section">
    <div class="section-title">Rincian Data</div>
    <div style="width: 100%; margin-bottom: 20px;">
        <div style="display: table; width: 100%; border-spacing: 15px;">
            <div style="display: table-row;">
                <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                    <div class="breakdown-item">
                        <div class="label">Berdasarkan Jenis Kelamin</div>
                        <div class="value">
                            Laki-laki: {{ number_format($laki_laki) }}<br>
                            Perempuan: {{ number_format($perempuan) }}
                        </div>
                    </div>
                </div>
                <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                    <div class="breakdown-item">
                        <div class="label">Berdasarkan Hasil Lab</div>
                        <div class="value">
                            Ada Hasil: {{ number_format($ada_hasil) }}<br>
                            Belum Ada: {{ number_format($belum_ada_hasil) }}
                        </div>
                    </div>
                </div>
                <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                    <div class="breakdown-item">
                        <div class="label">Berdasarkan Kategori</div>
                        <div class="value">
                            LPK Sentosa: {{ number_format($lpk_sentosa) }}<br>
                            Umum: {{ number_format($umum) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- Dokter Statistics -->
    @if($dokter_stats->count() > 0)
    <div class="section">
        <div class="dokter-stats">
            <h4>Statistik Dokter Pemeriksa (Top 5)</h4>
            <div class="dokter-list">
                @foreach($dokter_stats as $dokter)
                <div class="dokter-item">
                    <span class="dokter-name">{{ $dokter->dokter_pemeriksa }}</span>
                    <span class="dokter-count">{{ number_format($dokter->total) }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    
    <!-- Data Table -->
    <div class="section page-break">
        <div class="section-title">Data Pemeriksaan Laboratorium</div>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 8%">Tgl Pemeriksaan</th>
                    <th style="width: 5%">No Antrian</th>
                    <th style="width: 15%">Nama Pasien</th>
                    <th style="width: 5%">JK</th>
                    <th style="width: 8%">Umur</th>
                    <th style="width: 12%">Dokter Pemeriksa</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 8%">Kategori</th>
                    <th style="width: 10%">Jenis Pemeriksaan</th>
                    <th style="width: 16%">Hasil Lab</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laboratorium as $index => $lab)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($lab->tgl_pemeriksaan)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ $lab->no_antrian }}</td>
                    <td>{{ $lab->nama }}</td>
                    <td class="text-center">{{ $lab->jenis_kelamin }}</td>
                    <td class="text-center">{{ $lab->umur }} tahun</td>
                    <td>{{ $lab->dokter_pemeriksa ?? '-' }}</td>
                    <td class="text-center">
                        <span class="status-badge status-{{ str_replace(' ', '-', $lab->status_pemeriksaan) }}">
                            {{ ucfirst(str_replace('_', ' ', $lab->status_pemeriksaan)) }}
                        </span>
                    </td>
                    <td class="text-center">
                        {{ $lab->is_lpk_sentosa ? 'LPK Sentosa' : 'Umum' }}
                    </td>
                    <td>{{ $lab->jenis_pemeriksaan ?? '-' }}</td>
                    <td>
                        @if($lab->hasil_lab)
                            {{ Str::limit($lab->hasil_lab, 50) }}
                        @else
                            <span style="color: #6c757d; font-style: italic;">Belum ada hasil</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center" style="color: #6c757d; font-style: italic; padding: 20px;">
                        Tidak ada data pemeriksaan laboratorium untuk periode ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Summary Footer -->
    @if($laboratorium->count() > 0)
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6;">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            <div>
                <h4 style="margin: 0 0 10px 0; color: #495057;">Ringkasan Status:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #495057;">
                    <li>Menunggu: {{ number_format($menunggu) }} pemeriksaan</li>
                    <li>Sedang Diperiksa: {{ number_format($sedang_diperiksa) }} pemeriksaan</li>
                    <li>Selesai: {{ number_format($selesai) }} pemeriksaan</li>
                </ul>
            </div>
            <div>
                <h4 style="margin: 0 0 10px 0; color: #495057;">Ringkasan Hasil:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #495057;">
                    <li>Sudah Ada Hasil: {{ number_format($ada_hasil) }} pemeriksaan</li>
                    <li>Belum Ada Hasil: {{ number_format($belum_ada_hasil) }} pemeriksaan</li>
                    <li>Persentase Selesai: {{ $total_laboratorium > 0 ? number_format(($ada_hasil / $total_laboratorium) * 100, 1) : 0 }}%</li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Footer -->
    <div class="footer">
        <div>
            <strong>KLINIK MARCHSYA</strong> | 
            Laporan Laboratorium - {{ $judul_periode }} | 
            Halaman 1 dari 1
        </div>
    </div>
</body>
</html>