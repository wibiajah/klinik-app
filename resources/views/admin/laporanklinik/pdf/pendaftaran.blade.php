<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendaftaran - {{ $judul_periode }}</title>
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
        
        .stat-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
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
        .stat-card.success { border-left: 4px solid #28a745; }
        .stat-card.danger { border-left: 4px solid #dc3545; }
        .stat-card.warning { border-left: 4px solid #f39c12; }
        .stat-card.info { border-left: 4px solid #17a2b8; }
        
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
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 9px;
        }
        
        .data-table th,
        .data-table td {
            border: 1px solid #dee2e6;
            padding: 6px 4px;
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
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-menunggu {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-dikonfirmasi {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-ditolak {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .keluhan-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-pemeriksaan-umum {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .badge-lab {
            background-color: #fce4ec;
            color: #ad1457;
        }
        
        .badge-radiologi {
            background-color: #f3e5f5;
            color: #6a1b9a;
        }
        
        .gender-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
        }
        
        .badge-laki {
            background-color: #e3f2fd;
            color: #0d47a1;
        }
        
        .badge-perempuan {
            background-color: #fce4ec;
            color: #c2185b;
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
        <h1>LAPORAN PENDAFTARAN</h1>
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
        
        <!-- Row 1: Main Statistics -->
        <div style="width: 100%; margin-bottom: 20px;">
            <div style="display: table; width: 100%; border-spacing: 10px;">
                <div style="display: table-row;">
                    <div style="display: table-cell; width: 25%; vertical-align: top;">
                        <div class="stat-card primary">
                            <h3>Total Pendaftaran</h3>
                            <div class="number">{{ number_format($total_pendaftaran) }}</div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 25%; vertical-align: top;">
                        <div class="stat-card warning">
                            <h3>Menunggu</h3>
                            <div class="number">{{ number_format($menunggu) }}</div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 25%; vertical-align: top;">
                        <div class="stat-card success">
                            <h3>Dikonfirmasi</h3>
                            <div class="number">{{ number_format($dikonfirmasi) }}</div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 25%; vertical-align: top;">
                        <div class="stat-card danger">
                            <h3>Ditolak</h3>
                            <div class="number">{{ number_format($ditolak) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Detailed Breakdown -->
    <div class="section">
        <div class="section-title">Rincian Data</div>
        <div style="width: 100%; margin-bottom: 20px;">
            <div style="display: table; width: 100%; border-spacing: 15px;">
                <div style="display: table-row;">
                    <!-- Berdasarkan Keluhan -->
                    <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                        <div class="breakdown-item">
                            <div class="label">Berdasarkan Keluhan</div>
                            <div class="value">
                                Pemeriksaan Umum: {{ number_format($pemeriksaan_umum) }}<br>
                                Laboratorium: {{ number_format($lab) }}<br>
                                Radiologi: {{ number_format($radiologi) }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Berdasarkan Jenis Kelamin -->
                    <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                        <div class="breakdown-item">
                            <div class="label">Berdasarkan Jenis Kelamin</div>
                            <div class="value">
                                Laki-laki: {{ number_format($laki_laki) }}<br>
                                Perempuan: {{ number_format($perempuan) }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Berdasarkan Status -->
                    <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                        <div class="breakdown-item">
                            <div class="label">Persentase Status</div>
                            <div class="value">
                                Konfirmasi: {{ $total_pendaftaran > 0 ? number_format(($dikonfirmasi / $total_pendaftaran) * 100, 1) : 0 }}%<br>
                                Menunggu: {{ $total_pendaftaran > 0 ? number_format(($menunggu / $total_pendaftaran) * 100, 1) : 0 }}%<br>
                                Ditolak: {{ $total_pendaftaran > 0 ? number_format(($ditolak / $total_pendaftaran) * 100, 1) : 0 }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Summary Info -->
    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 11px; color: #495057;">
        <strong>Ringkasan Laporan:</strong> 
        Menampilkan {{ $pendaftaran->count() }} data pendaftaran untuk periode {{ $judul_periode }}.
    </div>
    
    <!-- Data Table -->
    <div class="section page-break">
        <div class="section-title">Data Pendaftaran</div>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 6%">ID</th>
                    <th style="width: 15%">Nama Lengkap</th>
                    <th style="width: 8%">NIK</th>
                    <th style="width: 5%">JK</th>
                    <th style="width: 8%">Umur</th>
                    <th style="width: 12%">Keluhan</th>
                    <th style="width: 8%">Status</th>
                    <th style="width: 10%">Tgl Submit</th>
                    <th style="width: 8%">Waktu</th>
                    <th style="width: 12%">No. Telepon</th>
                    <th style="width: 5%">BPJS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftaran as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center" style="font-weight: bold;">#{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->nik }}</td>
                    <td class="text-center">
                        @if($item->jenis_kelamin == 'L')
                            <span class="gender-badge badge-laki">L</span>
                        @else
                            <span class="gender-badge badge-perempuan">P</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->umur }} th</td>
                    <td class="text-center">
                        @if($item->keluhan == 'pemeriksaan_umum')
                            <span class="keluhan-badge badge-pemeriksaan-umum">Umum</span>
                        @elseif($item->keluhan == 'lab')
                            <span class="keluhan-badge badge-lab">Lab</span>
                        @elseif($item->keluhan == 'radiologi')
                            <span class="keluhan-badge badge-radiologi">Radio</span>
                        @else
                            <span class="keluhan-badge" style="background-color: #f3f4f6; color: #6b7280;">
                                {{ ucfirst($item->keluhan ?? 'Lain') }}
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->status == 'menunggu')
                            <span class="status-badge badge-menunggu">Menunggu</span>
                        @elseif($item->status == 'dikonfirmasi')
                            <span class="status-badge badge-dikonfirmasi">Konfirmasi</span>
                        @elseif($item->status == 'ditolak')
                            <span class="status-badge badge-ditolak">Ditolak</span>
                        @else
                            <span class="status-badge" style="background-color: #f3f4f6; color: #6b7280;">
                                {{ ucfirst($item->status ?? 'Unknown') }}
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $item->waktu_submit ? $item->waktu_submit->format('d/m/Y') : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $item->waktu_submit ? $item->waktu_submit->format('H:i') : '-' }}
                    </td>
                    <td class="text-center">{{ $item->no_telepon ?? '-' }}</td>
                    <td class="text-center">
                        @if($item->bpjs == 1 || $item->bpjs == true)
                            <span style="color: #28a745; font-weight: bold;">✓</span>
                        @else
                            <span style="color: #dc3545;">✗</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center" style="color: #6c757d; font-style: italic; padding: 20px;">
                        Tidak ada data pendaftaran untuk periode ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Summary Footer -->
    @if($pendaftaran->count() > 0)
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6;">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div>
                <h4 style="margin: 0 0 10px 0; color: #495057;">Ringkasan Status:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #495057;">
                    <li>Menunggu: {{ number_format($menunggu) }} pendaftaran</li>
                    <li>Dikonfirmasi: {{ number_format($dikonfirmasi) }} pendaftaran</li>
                    <li>Ditolak: {{ number_format($ditolak) }} pendaftaran</li>
                    <li>Total: {{ number_format($total_pendaftaran) }} pendaftaran</li>
                </ul>
            </div>
            <div>
                <h4 style="margin: 0 0 10px 0; color: #495057;">Berdasarkan Keluhan:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #495057;">
                    <li>Pemeriksaan Umum: {{ number_format($pemeriksaan_umum) }}</li>
                    <li>Laboratorium: {{ number_format($lab) }}</li>
                    <li>Radiologi: {{ number_format($radiologi) }}</li>
                </ul>
            </div>
            <div>
                <h4 style="margin: 0 0 10px 0; color: #495057;">Berdasarkan Gender:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #495057;">
                    <li>Laki-laki: {{ number_format($laki_laki) }} ({{ $total_pendaftaran > 0 ? number_format(($laki_laki / $total_pendaftaran) * 100, 1) : 0 }}%)</li>
                    <li>Perempuan: {{ number_format($perempuan) }} ({{ $total_pendaftaran > 0 ? number_format(($perempuan / $total_pendaftaran) * 100, 1) : 0 }}%)</li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Footer -->
    <div class="footer">
        <div>
            <strong>KLINIK MARCHSYA</strong> | 
            Laporan Pendaftaran - {{ $judul_periode }} | 
            Halaman 1 dari 1
        </div>
    </div>
</body>
</html>