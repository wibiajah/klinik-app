<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Keterangan - {{ $judul_periode }}</title>
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
        
        .badge-sehat {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-sakit {
            background-color: #f8d7da;
            color: #721c24;
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
        <h1>LAPORAN SURAT KETERANGAN</h1>
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
                    <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                        <div class="stat-card primary">
                            <h3>Total Surat</h3>
                            <div class="number">{{ number_format($total_surat) }}</div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                        <div class="stat-card success">
                            <h3>Surat Sehat</h3>
                            <div class="number">{{ number_format($surat_sehat) }}</div>
                        </div>
                    </div>
                    <div style="display: table-cell; width: 33.33%; vertical-align: top;">
                        <div class="stat-card danger">
                            <h3>Surat Sakit</h3>
                            <div class="number">{{ number_format($surat_sakit) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Detailed Breakdown -->
    @if(!empty($user_stats) || !empty($daily_stats))
    <div class="section">
        <div class="section-title">Rincian Data</div>
        <div style="width: 100%; margin-bottom: 20px;">
            <div style="display: table; width: 100%; border-spacing: 15px;">
                <div style="display: table-row;">
                    @if(!empty($user_stats))
                    <div style="display: table-cell; width: 50%; vertical-align: top;">
                        <div class="breakdown-item">
                            <div class="label">Berdasarkan Petugas</div>
                            <div class="value">
                                @foreach($user_stats->take(3) as $stat)
                                    {{ $stat['user_name'] }}: {{ number_format($stat['total']) }}<br>
                                @endforeach
                                @if($user_stats->count() > 3)
                                    <small style="color: #6c757d;">... dan {{ $user_stats->count() - 3 }} petugas lainnya</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($daily_stats))
                    <div style="display: table-cell; width: 50%; vertical-align: top;">
                        <div class="breakdown-item">
                            <div class="label">Berdasarkan Hari Teratas</div>
                            <div class="value">
                                @foreach($daily_stats->take(3) as $stat)
                                    {{ $stat['tanggal'] }}: {{ number_format($stat['total']) }}<br>
                                @endforeach
                                @if($daily_stats->count() > 3)
                                    <small style="color: #6c757d;">... dan {{ $daily_stats->count() - 3 }} hari lainnya</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Summary Info -->
    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 11px; color: #495057;">
        <strong>Ringkasan Laporan:</strong> 
        Menampilkan {{ $surat_keterangan->count() }} data surat keterangan
        @if($jenis_surat !== 'semua')
            ({{ $jenis_surat === 'sehat' ? 'Surat Sehat' : 'Surat Sakit' }} saja)
        @endif
        untuk periode {{ $judul_periode }}.
    </div>
    
    <!-- Data Table -->
    <div class="section page-break">
        <div class="section-title">Data Surat Keterangan</div>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%">No</th>
                    <th style="width: 8%">ID Surat</th>
                    <th style="width: 10%">Jenis Surat</th>
                    <th style="width: 25%">Konten</th>
                    <th style="width: 10%">Tgl Cetak</th>
                    <th style="width: 15%">Dicetak Oleh</th>
                    <th style="width: 8%">Waktu Cetak</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surat_keterangan as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center" style="font-weight: bold;">#{{ $item->id }}</td>
                    <td class="text-center">
                        @if($item->jenis_surat == 'sehat')
                            <span class="status-badge badge-sehat">
                                Surat Sehat
                            </span>
                        @elseif($item->jenis_surat == 'sakit')
                            <span class="status-badge badge-sakit">
                                Surat Sakit
                            </span>
                        @else
                            <span class="status-badge" style="background-color: #f3f4f6; color: #6b7280;">
                                {{ ucfirst($item->jenis_surat ?? 'Tidak diketahui') }}
                            </span>
                        @endif
                    </td>
                    <td>
                        @if($item->content)
                            {{ Str::limit(strip_tags($item->content), 100) }}
                        @else
                            <span style="color: #6c757d; font-style: italic;">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $item->printed_at ? $item->printed_at->format('d/m/Y') : '-' }}
                    </td>
                    <td>{{ $item->user->name ?? 'Unknown' }}</td>
                    <td class="text-center">
                        {{ $item->printed_at ? $item->printed_at->format('H:i:s') : '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center" style="color: #6c757d; font-style: italic; padding: 20px;">
                        Tidak ada data surat keterangan untuk periode ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Summary Footer -->
    @if($surat_keterangan->count() > 0)
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6;">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
            <div>
                <h4 style="margin: 0 0 10px 0; color: #495057;">Ringkasan Jenis Surat:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #495057;">
                    <li>Surat Sehat: {{ number_format($surat_sehat) }} surat</li>
                    <li>Surat Sakit: {{ number_format($surat_sakit) }} surat</li>
                    <li>Total Surat: {{ number_format($total_surat) }} surat</li>
                </ul>
            </div>
            <div>
                <h4 style="margin: 0 0 10px 0; color: #495057;">Statistik Tambahan:</h4>
                <ul style="margin: 0; padding-left: 20px; color: #495057;">
                    <li>Persentase Surat Sehat: {{ $total_surat > 0 ? number_format(($surat_sehat / $total_surat) * 100, 1) : 0 }}%</li>
                    <li>Persentase Surat Sakit: {{ $total_surat > 0 ? number_format(($surat_sakit / $total_surat) * 100, 1) : 0 }}%</li>
                    @if(!empty($user_stats))
                        <li>Jumlah Petugas Aktif: {{ $user_stats->count() }} orang</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Footer -->
    <div class="footer">
        <div>
            <strong>KLINIK MARCHSYA</strong> | 
            Laporan Surat Keterangan - {{ $judul_periode }} | 
            Halaman 1 dari 1
        </div>
    </div>
</body>
</html> 