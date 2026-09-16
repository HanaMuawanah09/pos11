@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<style>
    .detail-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .detail-header h1 {
        margin: 0;
    }

    .btn-print {
        background: #2f5ce0;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 18px;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-print:hover {
        background: #244bc0;
    }

    .detail-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .detail-info {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .detail-info-item small {
        display: block;
        color: #777;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .detail-info-item strong {
        font-size: 14px;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }

    .product-table th,
    .product-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }

    .product-table th {
        background: #f5f7fb;
        font-size: 13px;
    }

    .product-table td {
        font-size: 14px;
    }

    .product-table img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .total-row {
        text-align: right;
        font-size: 17px;
        font-weight: 700;
        margin-top: 20px;
    }

    .payment-row {
        text-align: right;
        font-size: 14px;
        margin-top: 6px;
        color: #444;
    }

    /* STRUK */
    .print-receipt {
        display: none;
    }

    @media print {

        body * {
            visibility: hidden;
        }

        .print-receipt,
        .print-receipt * {
            visibility: visible;
        }

        .print-receipt {
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 280px;
            padding: 10px;
            background: white;
            color: #000;
            font-family: Arial, sans-serif;
        }

        .print-receipt h2 {
            text-align: center;
            font-size: 18px;
            margin: 0 0 5px;
        }

        .store-info {
            text-align: center;
            font-size: 11px;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .receipt-info {
            font-size: 11px;
            line-height: 1.6;
        }

        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .receipt-table th,
        .receipt-table td {
            padding: 3px 0;
        }

        .receipt-table .right {
            text-align: right;
        }

        .receipt-total {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: bold;
        }

        .receipt-payment {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
        }

        .receipt-footer {
            text-align: center;
            font-size: 10px;
            margin-top: 15px;
        }

        @page {
            size: 80mm auto;
            margin: 5mm;
        }
    }

    @media (max-width: 768px) {
        .detail-info {
            grid-template-columns: 1fr;
        }

        .detail-header {
            gap: 10px;
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>


<div class="detail-container">

    {{-- HEADER --}}
    <div class="detail-header">

        <h1>Detail Penjualan</h1>

        <button type="button"
                class="btn-print"
                onclick="window.print()">
            🧾 Cetak Struk
        </button>

    </div>


    {{-- INFORMASI TRANSAKSI --}}
    <div class="detail-card">

        <div class="detail-info">

            <div class="detail-info-item">
                <small>Kasir</small>
                <strong>
                    {{ $sale->user->name }}
                </strong>
            </div>

            <div class="detail-info-item">
                <small>Tanggal Transaksi</small>
                <strong>
                    {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                </strong>
            </div>

            <div class="detail-info-item">
                <small>Metode Pembayaran</small>
                <strong>
                    {{ $sale->metode_pembayaran }}
                </strong>
            </div>

            <div class="detail-info-item">
                <small>Total Pembayaran</small>
                <strong>
                    Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                </strong>
            </div>

            @if($sale->uang_dibayar !== null)
            <div class="detail-info-item">
                <small>Uang Dibayar</small>
                <strong>
                    Rp {{ number_format($sale->uang_dibayar, 0, ',', '.') }}
                </strong>
            </div>
            @endif

            @if($sale->kembalian !== null)
            <div class="detail-info-item">
                <small>Kembalian</small>
                <strong>
                    Rp {{ number_format($sale->kembalian, 0, ',', '.') }}
                </strong>
            </div>
            @endif

        </div>

    </div>


    {{-- PRODUK --}}
    <div class="detail-card">

        <table class="product-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                </tr>
            </thead>

            <tbody>

                @php
                    $i = 1;
                @endphp

                @foreach($sale->itempenjualan as $item)

                    <tr>

                        <td>
                            {{ $i++ }}
                        </td>

                        <td>
                            <img
                                src="{{ asset('storage/' . $item->produk->foto) }}"
                                alt="{{ $item->produk->nama }}"
                            >
                        </td>

                        <td>
                            {{ $item->produk->nama }}
                        </td>

                        <td>
                            Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <div class="total-row">
            Total:
            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
        </div>

        @if($sale->uang_dibayar !== null)
        <div class="payment-row">
            Uang Dibayar: Rp {{ number_format($sale->uang_dibayar, 0, ',', '.') }}
        </div>
        @endif

        @if($sale->kembalian !== null)
        <div class="payment-row">
            Kembalian: Rp {{ number_format($sale->kembalian, 0, ',', '.') }}
        </div>
        @endif

    </div>

</div>


{{-- =====================================
     STRUK YANG AKAN DICETAK
     ===================================== --}}

<div class="print-receipt">

    <h2>POS HANA</h2>

    <div class="store-info">
        Point of Sale System
    </div>

    <div class="line"></div>

    <div class="receipt-info">

        <div>
            Tanggal :
            {{ $sale->created_at->format('d-m-Y H:i:s') }}
        </div>

        <div>
            Kasir :
            {{ $sale->user->name }}
        </div>

        <div>
            Pembayaran :
            {{ $sale->metode_pembayaran }}
        </div>

    </div>

    <div class="line"></div>

    <table class="receipt-table">

        <thead>
            <tr>
                <th>Produk</th>
                <th class="right">Harga</th>
            </tr>
        </thead>

        <tbody>

            @foreach($sale->itempenjualan as $item)

                <tr>

                    <td>
                        {{ $item->produk->nama }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="line"></div>

    <div class="receipt-total">

        <span>TOTAL</span>

        <span>
            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
        </span>

    </div>

    @if($sale->uang_dibayar !== null)
    <div class="receipt-payment">
        <span>BAYAR</span>
        <span>Rp {{ number_format($sale->uang_dibayar, 0, ',', '.') }}</span>
    </div>
    @endif

    @if($sale->kembalian !== null)
    <div class="receipt-payment">
        <span>KEMBALI</span>
        <span>Rp {{ number_format($sale->kembalian, 0, ',', '.') }}</span>
    </div>
    @endif

    <div class="line"></div>

    <div class="receipt-footer">
        Terima kasih telah berbelanja
        <br>
        POS Hana
    </div>

</div>

@endsection