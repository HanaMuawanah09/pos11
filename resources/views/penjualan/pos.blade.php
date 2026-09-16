@extends('layouts.app')

@section('title', 'POS')

@section('content')

@if(session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

<h4 class="mb-3">
    Tambah dan Edit
</h4>

<div class="row">

    {{-- =================== PRODUK =================== --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">
                <div class="mb-3">
                    <form method="GET" action="{{ route('penjualan.create') }}">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Cari produk..."
                               onkeyup="this.form.submit()">
                    </form>
                </div>
                @foreach($products as $product)
                    <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="col-7">
                            <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disable' : '' }}">
                                <div class="d-flex align-items-center gap-2">

                                    {{-- Nama & harga --}}
                                    <div>
                                        <div class="fw-semibold">{{ $product->nama }}</div>
                                        <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                                    </div>

                                </div>
                            </button>
                        </div>

                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                        class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : ''}}">
                            </div>

                            <div class="col-2">
                                <button class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>

    {{-- =================== KERANJANG =================== --}}
    <div class="col-md-6">
        <div class="card">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>SubTotal</th>
                        <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale->ItemPenjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama }}</td>
                    <td>Rp. {{ number_format($item->produk->harga_jual) }}</td>
                    <td>
                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                            @csrf @method('PUT')
                            <input type="number" name="quantity"
                                   value="{{ $item->kuantitas }}"
                                   class="form-control form-control-sm">
                        </form>
                    </td>
                    <td>Rp. {{ number_format($item->subtotal) }}</td>
                    <td>
                        @can('delete', $item)
                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Keranjang kosong
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="card-footer">
            <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>

        <form method="POST"
            action="{{ route('penjualan.update', $sale->id) }}"
            onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
            @csrf
            @method('PUT')

            <select name="payment_method" id="payment_method" class="form-select mb-2" onchange="toggleUangDibayar()">
                <option value="">Pilih Pembayaran</option>
                <option value="CASH">Cash</option>
                <option value="QRIS">QRIS</option>
            </select>

            <div id="qris_wrapper" class="text-center border rounded p-3 mb-2" style="display:none;">
                <div class="fw-semibold mb-2">Scan QRIS untuk membayar</div>
                <img id="qris_barcode"
                     src=""
                     alt="Barcode QRIS pembayaran"
                     width="200"
                     height="200"
                     class="img-fluid border p-2 bg-white">
                <div class="small text-muted mt-2">
                    Total: <strong id="qris_total">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</strong>
                </div>
            </div>

            <div id="uang_dibayar_wrapper" style="display:none;">
                <input type="number"
                       name="uang_dibayar"
                       id="uang_dibayar"
                       class="form-control mb-2"
                       placeholder="Jumlah uang diterima"
                       min="0"
                       oninput="hitungKembalian()">

                <div class="mb-2">
                    Kembalian: <strong id="kembalian_display">Rp 0</strong>
                </div>
            </div>

            <button class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                Checkout
            </button>
        </form>
@can('delete', $sale)
         <form action="{{ route('penjualan.destroy', $sale->id) }}"
    method="POST"
    onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
    @csrf
    @method('DELETE')

    <button class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
        Batalkan Transaksi
        </button>
    </form>
    @endcan
        </div>
    </div>
</div>

</div>

<script>
    const totalPembayaran = {{ $sale->total_pembayaran }};

    function toggleUangDibayar() {
        const method = document.getElementById('payment_method').value;
        const wrapper = document.getElementById('uang_dibayar_wrapper');
        const qrisWrapper = document.getElementById('qris_wrapper');
        const qrisBarcode = document.getElementById('qris_barcode');
        const input = document.getElementById('uang_dibayar');

        if (method === 'CASH') {
            wrapper.style.display = 'block';
            qrisWrapper.style.display = 'none';
            input.required = true;
        } else if (method === 'QRIS') {
            wrapper.style.display = 'none';
            qrisWrapper.style.display = 'block';
            input.required = false;
            qrisBarcode.src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' +
                encodeURIComponent('QRIS POS10|Total: Rp ' + totalPembayaran.toLocaleString('id-ID'));
            input.value = '';
        } else {
            wrapper.style.display = 'none';
            qrisWrapper.style.display = 'none';
            input.required = false;
            input.value = '';
            document.getElementById('kembalian_display').innerText = 'Rp 0';
        }
    }

    function hitungKembalian() {
        const bayar = parseFloat(document.getElementById('uang_dibayar').value) || 0;
        const kembalian = bayar - totalPembayaran;
        document.getElementById('kembalian_display').innerText =
            'Rp ' + (kembalian > 0 ? kembalian.toLocaleString('id-ID') : 0);
    }
</script>
@endsection