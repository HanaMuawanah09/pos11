{{-- memanggil file app.blade.php --}}
@extends('layouts.app')

{{-- mengirimkan nilai ke title untuk ditampilkan --}}
@section('title', 'Login')

{{-- batas awal isi konten --}}
@section('content')


<div class="text-center">
  <h1>
    Ringkasan Hari Ini
    <small class="text-muted">
      ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
    </small>
  </h1>

  <div class="row">
    @can('viewAny', App\Models\User::class)
    <div class="col-md-12">
      <h1>Today's Sales</h1>
    </div>

    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header">
          Total Nilai Penjualan Hari ini
        </div>
        <div class="card-body">
          <h4>Rp. {{ number_format($ringkasan['total_penjualan']) }}</h4>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header">
          Jumlah transaksi hari ini
        </div>
        <div class="card-body">
          <h4>{{ number_format($ringkasan['total_transaksi']) }}</h4>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <h1>Cash &amp; Payment Status</h1>
    </div>

    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header">
          Total pembayaran tunai
        </div>
        <div class="card-body">
          <h4>Rp. {{ number_format($ringkasan['total_cash']) }}</h4>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-header">
          Total pembayaran non tunai
        </div>
        <div class="card-body">
          <h4>Rp. {{ number_format($ringkasan['total_non_tunai']) }}</h4>
        </div>
      </div>
    </div>
    @endcan

    <div class="col-md-12">
      <h1>Critical Inventory Status</h1>
    </div>

    <div class="col-md-6">
      <h3>Daftar produk stok rendah</h3>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">nama</th>
            <th scope="col">stok</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($produkStokRendah as $index => $produk)
            <tr>
              <td>{{ $produkStokRendah->firstItem() + $index }}</td>
              <td>{{ $produk->nama }}</td>
              <td>{{ $produk->stok }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-muted text-center">
                Seluruh produk berada dalam kondisi stok aman.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $produkStokRendah->links() }}
    </div>

    <div class="col-md-6">
      <h3>Produk habis stok</h3>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">nama</th>
            <th scope="col">stok</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($produkStokHabis as $index => $produk)
            <tr>
              <td>{{ $produkStokHabis->firstItem() + $index }}</td>
              <td>{{ $produk->nama }}</td>
              <td>{{ $produk->stok }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-muted text-center">
                Seluruh produk berada dalam kondisi stok aman.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $produkStokHabis->links() }}
    </div>

    <div class="col-md-12">
      <h1>Best Seller Products</h1>
    </div>
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">nama</th>
            <th scope="col">stok</th>
            <th scope="col">unit terjual</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($produkTerlaris as $produk)
            <tr>
              <td>{{ $produk->nama }}</td>
              <td>{{ $produk->stok }}</td>
              <td>{{ $produk->total_terjual }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-muted text-center">
                Belum ada data penjualan produk.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>

{{-- batas Akhir isi konten --}}
@endsection