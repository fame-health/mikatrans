<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kwitansi Pelunasan</title>

<style>
@page {
    size: 28cm 9cm;
    margin: 4mm;
}

body {
    margin: 0;
    padding: 0;
    font-family: "Times New Roman", serif;
    font-size: 9.5px;
}

/* ANTI PAGE BREAK */
table, tr, td {
    border-collapse: collapse;
    page-break-inside: avoid !important;
}

/* BOX */
.kwitansi {
    width: 100%;
    height: 7.8cm;
    border: 1px solid #000;
    overflow: hidden;
}

/* HEADER */
.company h1 {
    margin: 0;
    font-size: 12px;
    color: #b00000;
}

.company p {
    margin: 1px 0;
    font-size: 9px;
}

.title {
    text-align: right;
}

.title h2 {
    margin: 0;
    font-size: 14px;
    letter-spacing: 1px;
}

/* CONTENT */
.content {
    font-size: 10.5px;
}

.label {
    width: 40mm;
}

.colon {
    width: 5mm;
    text-align: center;
}

.value {
    border-bottom: 1.2px dotted #000;
    padding-bottom: 2px;
}

/* FOOTER */
.note {
    font-size: 8px;
    color: #b00000;
}

.signature {
    text-align: center;
    font-size: 9px;
}
</style>
</head>

<body>

<table class="kwitansi">
<tr>
<td style="padding:5mm">

<!-- ================= HEADER ================= -->
<table width="100%">
<tr>
    <td class="company">
        <h1>PT. MIKA TRANS PARIWISATA</h1>
        <p>Jl. H. Usman Kasang Kulim Simp. Kebun Binatang</p>
        <p>Ruko No. 1A Kubang Raya</p>
        <p>HP: 0812-6196-9221 | 0882-7126-2334</p>
    </td>
    <td class="title">
        <h2>KWITANSI</h2>
        <p>No: {{ $booking->booking_code }}</p>
    </td>
</tr>
</table>

<br>

<!-- ================= CONTENT ================= -->
<table class="content" width="100%">

<tr>
    <td class="label">Sudah terima dari</td>
    <td class="colon">:</td>
    <td class="value">{{ $booking->customer_name }}</td>
</tr>

<tr>
    <td class="label">Uang DP</td>
    <td class="colon">:</td>
    <td class="value">
        Rp {{ number_format($booking->dp_amount, 0, ',', '.') }}
    </td>
</tr>

<tr>
    <td class="label">Uang Pelunasan</td>
    <td class="colon">:</td>
    <td class="value">
        Rp {{ number_format($booking->total_price - $booking->dp_amount, 0, ',', '.') }}
    </td>
</tr>

<tr>
    <td class="label">Untuk pembayaran</td>
    <td class="colon">:</td>
    <td class="value">
        Sewa Kendaraan {{ $booking->vehicle->name ?? '-' }}
    </td>
</tr>

<tr>
    <td class="label">Tujuan</td>
    <td class="colon">:</td>
    <td class="value">
        {{ $booking->pickup_location }} - {{ $booking->dropoff_location }}
    </td>
</tr>

<!-- ===== TOTAL (DP + LUNAS) ===== -->
<tr>
    <td class="label"><strong>JUMLAH TOTAL</strong></td>
    <td class="colon">:</td>
    <td class="value">
        <strong>
            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
        </strong>
        <span style="font-size:9px;">
            (DP + Pelunasan)
        </span>
    </td>
</tr>

</table>

<br>

<!-- ================= FOOTER ================= -->
<table width="100%">
<tr>
    <td class="note">
        <strong>NB:</strong><br>
        1. DP minimal 25% dari harga sewa<br>
        2. DP tidak dapat dikembalikan<br>
        3. Fasilitas hanya berlaku di dalam armada
    </td>

    <td class="signature">
        Kubang Raya, {{ now()->format('d F Y') }}<br><br>
        Penerima,<br><br>
        <strong>PT. Mika Trans Pariwisata</strong>
    </td>
</tr>
</table>

</td>
</tr>
</table>

</body>
</html>
