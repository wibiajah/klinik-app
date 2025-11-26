<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($jenis_surat) }} - Template PDF</title>
    <style>
        @page {
            margin: 2cm;
            size: A4;
        }
        
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
            margin: 0;
            padding: 0;
        }
        
        .kop-surat {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px double #000;
        }
        
        .kop-surat h2 {
            font-size: 18pt;
            font-weight: bold;
            margin: 0;
            color: #000;
        }
        
        .kop-surat p {
            font-size: 10pt;
            margin: 5px 0;
            line-height: 1.4;
        }
        
        .content {
            margin-top: 20px;
        }
        
        .content h2 {
            font-size: 16pt;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .content p {
            margin-bottom: 15px;
            text-align: justify;
        }
        
        /* PERBAIKAN UTAMA: Styling tabel yang lebih spesifik */
        .content table {
            width: 100%;
            border: none;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        
        .content table td {
            padding: 5px 0;
            vertical-align: top;
            border: none;
        }
        
        .content table td:first-child {
            width: 120px;
        }
        
        .content table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }
        
        /* HANYA kolom ketiga yang dapat border-bottom untuk field kosong */
        .content table td:nth-child(3) {
            border-bottom: 1px solid #000;
            min-height: 20px;
            position: relative;
        }
        
        /* Style untuk blank line yang konsisten */
        .blank-line {
            display: inline-block;
            min-width: 200px;
            border-bottom: 1px solid #000;
            height: 18px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .mb-3 {
            margin-bottom: 15px;
        }
        
        .mb-4 {
            margin-bottom: 20px;
        }
        
        .mb-5 {
            margin-bottom: 25px;
        }
        
        .mt-5 {
            margin-top: 25px;
        }
        
        strong {
            font-weight: bold;
        }
        
        .footer-info {
            position: fixed;
            bottom: 1cm;
            right: 2cm;
            font-size: 8pt;
            color: #666;
        }
        
        /* Print specific styles */
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <h2>KLINIK MARCHSYA</h2>
        <p>
            Alamat: <span class="blank-line"></span><br>
            Telp: <span class="blank-line"></span> | Email: <span class="blank-line"></span>
        </p>
    </div>

    <!-- Content Template -->
    <div class="content">
        @if($template && $template->content)
            {!! $template->content !!}
        @else
            <!-- Default template jika tidak ada di database -->
            <div class="text-center mb-4">
                <h2><strong>SURAT KETERANGAN SEHAT</strong></h2>
                <p>No: <span class="blank-line"></span></p>
            </div>
            
            <p>Yang bertanda tangan di bawah ini, Dokter:</p>
            
            <table class="mb-3">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>SIP</td>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
            
            <p>Menerangkan bahwa:</p>
            
            <table class="mb-3">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>TTL</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
            
            <p><strong>Dalam keadaan SEHAT</strong> dan dapat melakukan aktivitas normal.</p>
            
            <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
            
            <div class="mt-5 text-right">
                <p><span class="blank-line"></span>, <span class="blank-line"></span></p>
                <p class="mt-5">
                    <strong><span class="blank-line"></span></strong><br>
                    Dokter
                </p>
            </div>
        @endif
    </div>

    <!-- Footer dengan info pencetakan -->
    <div class="footer-info">
        Dicetak: {{ $tanggal_cetak }}
    </div>

    <!-- HAPUS JAVASCRIPT yang menyebabkan double border -->
    <!-- JavaScript ini tidak perlu karena sudah handle di CSS -->
</body>
</html>