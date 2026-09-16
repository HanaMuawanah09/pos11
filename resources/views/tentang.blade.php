@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
<style>
    .tt-hero{
        background: linear-gradient(135deg, #2f5ce0 0%, #1a3fa8 100%);
        border-radius: 18px;
        padding: 40px 36px;
        color: #fff;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .tt-hero::after{
        content: '';
        position: absolute;
        right: -60px; top: -60px;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .tt-hero::before{
        content: '';
        position: absolute;
        right: 40px; bottom: -80px;
        width: 160px; height: 160px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
    }
    .tt-hero-badge{
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 999px;
        padding: 5px 14px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 14px;
    }
    .tt-hero h1{
        color: #fff;
        font-size: 28px;
        margin-bottom: 8px;
    }
    .tt-hero p{
        color: rgba(255,255,255,0.85);
        font-size: 14.5px;
        max-width: 520px;
        margin: 0;
        line-height: 1.6;
    }

    .tt-stats{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }
    .tt-stat{
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 18px 16px;
        text-align: center;
        box-shadow: 0 2px 6px rgba(20,30,60,0.05);
    }
    .tt-stat .num{
        font-family: 'IBM Plex Mono', monospace;
        font-size: 24px;
        font-weight: 700;
        color: var(--blue);
    }
    .tt-stat .label{
        font-size: 11.5px;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        margin-top: 4px;
    }

    .tt-section-title{
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--blue);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .tt-section-title::before{
        content: '';
        width: 4px; height: 16px;
        background: var(--blue);
        border-radius: 2px;
    }

    .tt-features{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 30px;
    }
    .tt-feature{
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 18px;
        transition: transform .15s, box-shadow .15s;
    }
    .tt-feature:hover{
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(47,92,224,0.12);
        border-color: #c7d6f7;
    }
    .tt-feature .icon{
        width: 38px; height: 38px;
        border-radius: 10px;
        background: var(--blue-light);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
    }
    .tt-feature .icon svg{ width: 20px; height: 20px; }
    .tt-feature .title{
        font-weight: 800;
        font-size: 14px;
        margin-bottom: 4px;
        color: var(--text);
    }
    .tt-feature .desc{
        font-size: 12.5px;
        color: var(--muted);
        line-height: 1.5;
    }

    .tt-steps{
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 22px 24px;
        margin-bottom: 30px;
    }
    .tt-step{
        display: flex;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px dashed var(--border);
    }
    .tt-step:last-child{ border-bottom: none; }
    .tt-step .num{
        flex-shrink: 0;
        width: 30px; height: 30px;
        border-radius: 50%;
        background: var(--blue);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        font-family: 'IBM Plex Mono', monospace;
    }
    .tt-step .title{ font-weight: 700; font-size: 13.5px; color: var(--text); margin-bottom: 2px; }
    .tt-step .desc{ font-size: 12.5px; color: var(--muted); }

    .tt-profile{
        background: linear-gradient(180deg, #fff 0%, #f7f9fd 100%);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 26px;
        box-shadow: 0 2px 8px rgba(20,30,60,0.05);
    }
    .tt-profile-top{
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }
    .tt-avatar{
        width: 62px; height: 62px;
        border-radius: 16px;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(47,92,224,0.3);
    }
    .tt-avatar img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .tt-profile-name{ font-size: 17px; font-weight: 800; color: var(--text); }
    .tt-profile-role{ font-size: 12.5px; color: var(--blue); font-weight: 700; margin-top: 2px; }

    .tt-badges{
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }
    .tt-badge{
        background: var(--blue-light);
        color: var(--blue);
        font-size: 11.5px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 999px;
    }

    .tt-contact-grid{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .tt-contact-item{
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 12px 14px;
    }
    .tt-contact-item .label{
        font-size: 10.5px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: var(--muted-2);
        font-weight: 700;
        margin-bottom: 3px;
    }
    .tt-contact-item .value{
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
    }

    .tt-quote{
        margin-top: 20px;
        padding: 14px 16px;
        border-left: 3px solid var(--blue);
        background: var(--blue-light);
        border-radius: 0 10px 10px 0;
        font-size: 13px;
        color: #2a3a63;
        font-style: italic;
    }

    @media (max-width: 768px){
        .tt-features{ grid-template-columns: 1fr; }
        .tt-stats{ grid-template-columns: 1fr; }
        .tt-contact-grid{ grid-template-columns: 1fr; }
    }
</style>

<div style="max-width: 780px; margin: 0 auto; padding: 4px 0 30px;">

    <div class="tt-hero">
        <span class="tt-hero-badge">✦ Point of Sale System</span>
        <h1>Aplikasi POS</h1>
        <p>
            Sistem kasir digital yang dirancang untuk mempercepat pencatatan penjualan,
            menjaga akurasi stok, dan memberi gambaran bisnis secara real-time —
            menggantikan pencatatan manual yang rawan salah hitung.
        </p>
    </div>

    <div class="tt-stats">
        <div class="tt-stat">
            <div class="num">4+</div>
            <div class="label">Modul Utama</div>
        </div>
        <div class="tt-stat">
            <div class="num">3</div>
            <div class="label">Metode Bayar</div>
        </div>
        <div class="tt-stat">
            <div class="num">24/7</div>
            <div class="label">Bisa Diakses</div>
        </div>
    </div>

    <div class="tt-section-title">Fitur unggulan</div>
    <div class="tt-features">
        <div class="tt-feature">
            <div class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div class="title">Manajemen produk</div>
            <div class="desc">Tambah, ubah, hapus, dan cari data produk dengan cepat dan rapi.</div>
        </div>
        <div class="tt-feature">
            <div class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m-10 4a1 1 0 100-2 1 1 0 000 2zm10 0a1 1 0 100-2 1 1 0 000 2z"/></svg>
            </div>
            <div class="title">Transaksi real-time</div>
            <div class="desc">Setiap penjualan langsung tercatat dan stok otomatis diperbarui.</div>
        </div>
        <div class="tt-feature">
            <div class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2z"/></svg>
            </div>
            <div class="title">Dashboard ringkasan</div>
            <div class="desc">Pantau total penjualan, pembayaran, dan stok kritis setiap hari.</div>
        </div>
        <div class="tt-feature">
            <div class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 3a4 4 0 10-8 0"/></svg>
            </div>
            <div class="title">Manajemen pengguna</div>
            <div class="desc">Hak akses berbeda untuk admin dan kasir demi keamanan data.</div>
        </div>
        <div class="tt-feature">
            <div class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v2m0 4h.01M5.07 19H19a2 2 0 001.75-2.97l-7-12.55a2 2 0 00-3.5 0l-7 12.55A2 2 0 005.07 19z"/></svg>
            </div>
            <div class="title">Pantauan stok</div>
            <div class="desc">Peringatan otomatis untuk produk yang stoknya rendah atau habis.</div>
        </div>
        <div class="tt-feature">
            <div class="icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
            </div>
            <div class="title">Metode pembayaran</div>
            <div class="desc">Mendukung pembayaran tunai, QRIS, dan transfer bank.</div>
        </div>
    </div>

    <div class="tt-section-title">Cara kerja aplikasi</div>
    <div class="tt-steps">
        <div class="tt-step">
            <div class="num">1</div>
            <div>
                <div class="title">Kelola data produk</div>
                <div class="desc">Admin menambahkan produk beserta harga beli, harga jual, dan stok awal.</div>
            </div>
        </div>
        <div class="tt-step">
            <div class="num">2</div>
            <div>
                <div class="title">Proses penjualan</div>
                <div class="desc">Kasir mencatat transaksi saat pelanggan membeli, stok otomatis berkurang.</div>
            </div>
        </div>
        <div class="tt-step">
            <div class="num">3</div>
            <div>
                <div class="title">Pantau melalui dashboard</div>
                <div class="desc">Admin melihat ringkasan penjualan harian dan status stok secara real-time.</div>
            </div>
        </div>
        <div class="tt-step">
            <div class="num">4</div>
            <div>
                <div class="title">Evaluasi dan tindak lanjut</div>
                <div class="desc">Data yang tercatat rapi memudahkan pengambilan keputusan bisnis.</div>
            </div>
        </div>
    </div>

    <div class="tt-section-title">Profil pengembang</div>
    <div class="tt-profile">
        <div class="tt-profile-top">
            <div class="tt-avatar">
                <img src="{{ asset('images/hna.gif') }}" alt="Hana Muawanah">
            </div>
            <div>
                <div class="tt-profile-name">Hana Muawanah</div>
                <div class="tt-profile-role">Pelajar SMKN 4 Kota Tasikmalaya</div>
            </div>
        </div>

        <div class="tt-badges">
            <span class="tt-badge">PPLG</span>
            <span class="tt-badge">Laravel</span>
            <span class="tt-badge">PHP</span>
            <span class="tt-badge">MySQL</span>
        </div>

        <div class="tt-contact-grid">
            <div class="tt-contact-item">
                <div class="label">email</div>
                <div class="value">[242510296@smkn4-tsm.sch.id]</div>
            </div>
            <div class="tt-contact-item">
                <div class="label">no</div>
                <div class="value">[085877392193]</div>
            </div>
            <div class="tt-contact-item">
                <div class="label">Sekolah</div>
                <div class="value">SMKN 4 Kota Tasikmalaya</div>
            </div>
            <div class="tt-contact-item">
                <div class="label">Jurusan</div>
                <div class="value">Pengembangan Perangkat Lunak dan Gim</div>
            </div>
        </div>

        <div class="tt-quote">
            "Aplikasi ini dibuat sebagai bagian dari pembelajaran dan praktik pengembangan
            perangkat lunak, sekaligus solusi nyata untuk membantu pencatatan usaha kecil."
        </div>
    </div>

</div>
@endsection