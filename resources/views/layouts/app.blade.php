<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') — POS Hana</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
      :root{
        --bg: #eef1f7;
        --surface: #ffffff;
        --surface-2: #f5f7fb;
        --border: #e3e7f0;
        --blue: #2f5ce0;
        --blue-2: #4a72f0;
        --blue-deep: #16276b;
        --blue-light: #eef2ff;
        --text: #171d2e;
        --muted: #6b7385;
        --muted-2: #9aa1b0;
        --green: #1a9d6b;
        --green-bg: #e8f8f1;
        --amber: #c17d1f;
        --amber-bg: #fdf4e5;
        --red: #d33d47;
        --red-bg: #fdecee;
        --gold: #dba829;
      }

      *{ box-sizing: border-box; }

      body{
        background:
          radial-gradient(700px 420px at 8% 0%, rgba(47,92,224,0.05), transparent 55%),
          radial-gradient(650px 420px at 100% 15%, rgba(47,92,224,0.04), transparent 55%),
          var(--bg);
        color: var(--text);
        font-family: 'Manrope', system-ui, sans-serif;
        min-height: 100vh;
      }

      .container.mt-3{ max-width: 1180px; }

      /* Flash message */
      .alert-success{
        background: var(--green-bg);
        border: 1px solid #c9ecdd;
        color: var(--green);
        border-radius: 12px;
        font-weight: 700;
        font-size: 13.5px;
        padding: 13px 18px;
        box-shadow: 0 4px 14px rgba(20,30,60,0.04);
      }

      /* Navbar */
      .navbar{
        background:
          radial-gradient(420px 120px at 0% 0%, rgba(255,255,255,0.10), transparent 60%),
          linear-gradient(120deg, var(--blue-deep) 0%, var(--blue) 60%, var(--blue-2) 120%) !important;
        border: none;
        border-radius: 16px;
        padding: 12px 22px;
        margin-bottom: 30px;
        box-shadow: 0 18px 40px -18px rgba(22,39,107,0.55);
      }
      .navbar-brand{
        color: #fff !important;
        font-weight: 900;
        font-size: 16.5px;
        letter-spacing: -0.2px;
        display: inline-flex;
        align-items: center;
      }
      .navbar-brand img{
        width: 29px; height: 29px;
        object-fit: contain;
        margin-right: 10px;
        border-radius: 6px;
      }
      .nav-link{
        color: rgba(255,255,255,0.72) !important;
        font-weight: 700;
        font-size: 13.5px;
        padding: 8px 14px !important;
        border-radius: 9px;
        margin-right: 2px;
        transition: .15s;
      }
      .nav-link:hover{ color: #fff !important; background: rgba(255,255,255,0.10); }
      .nav-link.active{
        color: #fff !important;
        background: rgba(255,255,255,0.16);
        box-shadow: inset 0 0 0 1px rgba(255,255,255,0.18);
      }

      /* Tombol Logout di navbar (bukan tombol Hapus di halaman lain) */
      .navbar .btn-danger{
        background: rgba(255,255,255,0.10);
        border: 1px solid rgba(255,255,255,0.25);
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        border-radius: 9px;
        padding: 7px 17px;
      }
      .navbar .btn-danger:hover{
        background: var(--red);
        color: #fff;
        border-color: var(--red);
      }

      /* Tombol Hapus (di luar navbar) */
      .btn-danger{
        background: var(--red-bg);
        border: 1px solid #f4c9cd;
        color: var(--red);
        font-weight: 800;
        font-size: 13px;
        border-radius: 9px;
        padding: 7px 16px;
      }
      .btn-danger:hover{
        background: var(--red);
        color: #fff;
        border-color: var(--red);
      }

      /* Headings */
      h1{
        font-size: 23px;
        font-weight: 900;
        letter-spacing: -0.4px;
        color: var(--text);
        margin-top: 4px;
        margin-bottom: 18px;
      }
      h1 small{
        font-size: 13px;
        color: var(--muted) !important;
        font-weight: 600;
      }
      h3{
        font-size: 12.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--muted);
        margin: 8px 0 12px;
      }
      h4{
        font-size: 18px;
        font-weight: 800;
        letter-spacing: -0.2px;
        color: var(--text);
      }

      /* Cards (KPI) */
      .card{
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 18px;
        box-shadow: 0 10px 26px -16px rgba(20,30,60,0.16);
        transition: .15s;
      }
      .card:hover{ box-shadow: 0 14px 34px -16px rgba(20,30,60,0.22); }
      .card-header{
        background: var(--surface-2);
        border-bottom: 1px solid var(--border);
        color: var(--muted);
        font-size: 11.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 13px 18px;
      }
      .card-body{
        padding: 18px 18px 20px;
      }
      .card-body h4{
        font-family: 'IBM Plex Mono', monospace;
        font-size: 25px;
        font-weight: 700;
        color: var(--blue);
        margin: 0;
        letter-spacing: -0.5px;
      }
      .card-title{ font-weight: 800; font-size: 15px; }
      .card-subtitle{ font-size: 12.5px; }
      .card-text{ font-size: 13.5px; color: var(--text); }

      /* Section headings that used <h1> as section titles get a top rule */
      .row > .col-md-12 > h1{
        padding-top: 10px;
        margin-top: 10px;
        border-top: 1px solid var(--border);
      }
      .row > .col-md-12:first-child > h1{
        border-top: none;
        padding-top: 0;
        margin-top: 0;
      }

      /* Tables */
      .table{
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        color: var(--text);
        box-shadow: 0 10px 26px -18px rgba(20,30,60,0.14);
      }
      .table thead th{
        background: var(--surface-2);
        color: var(--muted);
        text-transform: uppercase;
        font-size: 10.5px;
        letter-spacing: 0.9px;
        font-weight: 800;
        border-bottom: 1px solid var(--border);
        padding: 12px 16px;
      }
      .table tbody td, .table tbody th{
        border-bottom: 1px solid var(--border);
        padding: 12px 16px;
        font-size: 13.5px;
        vertical-align: middle;
      }
      .table tbody tr:last-child td{ border-bottom: none; }
      .table tbody tr:hover td{ background: var(--blue-light); }
      .text-muted{ color: var(--muted-2) !important; }

      /* Pagination */
      .pagination .page-link{
        background: var(--surface);
        border-color: var(--border);
        color: var(--muted);
        font-weight: 600;
        border-radius: 8px;
        margin: 0 2px;
      }
      .pagination .page-item.active .page-link{
        background: var(--blue);
        border-color: var(--blue);
        color: #fff;
      }

      /* Forms */
      .form-label{
        font-weight: 800;
        font-size: 12.5px;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 7px;
      }
      .form-control, .form-select{
        background: var(--surface-2);
        border: 1.5px solid var(--border);
        border-radius: 9px;
        font-size: 13.5px;
        padding: 10px 13px;
        color: var(--text);
      }
      .form-control:focus, .form-select:focus{
        border-color: var(--blue);
        box-shadow: 0 0 0 4px rgba(47,92,224,0.12);
        outline: none;
        background: #fff;
      }
      .invalid-feedback{
        font-size: 12px;
        font-weight: 700;
      }

      .btn-primary, .btn-success{
        background: linear-gradient(135deg, var(--blue) 0%, var(--blue-2) 100%);
        border: none;
        color: #fff;
        font-weight: 800;
        font-size: 13px;
        border-radius: 9px;
        padding: 9px 20px;
        box-shadow: 0 12px 24px -10px rgba(47,92,224,0.5);
        transition: .15s;
      }
      .btn-primary:hover, .btn-success:hover{
        filter: brightness(1.08);
        transform: translateY(-1px);
        color: #fff;
      }
      .btn-secondary{
        background: var(--surface);
        border: 1.5px solid var(--border);
        color: var(--muted);
        font-weight: 800;
        font-size: 13px;
        border-radius: 9px;
        padding: 9px 20px;
      }
      .btn-secondary:hover{
        background: var(--surface-2);
        color: var(--text);
      }
      .btn-warning{
        background: var(--amber-bg);
        border: 1px solid #f3dcae;
        color: var(--amber);
        font-weight: 800;
        font-size: 13px;
        border-radius: 8px;
        padding: 7px 16px;
      }
      .btn-warning:hover{ background: var(--amber); color: #fff; }
      .btn-info{
        background: var(--blue-light);
        border: 1px solid #cdd8fb;
        color: var(--blue);
        font-weight: 800;
        font-size: 13px;
        border-radius: 8px;
        padding: 7px 16px;
      }
      .btn-info:hover{ background: var(--blue); color: #fff; }
      .btn-outline-primary{
        border: 1.5px solid var(--border);
        color: var(--text);
        border-radius: 9px;
        font-weight: 700;
      }
      .btn-outline-primary:hover{
        background: var(--blue-light);
        border-color: var(--blue);
        color: var(--blue);
      }
      .btn-outline-secondary{
        border: 1.5px solid var(--border);
        color: var(--muted);
        border-radius: 0 9px 9px 0;
      }
      .btn-outline-danger{
        border: 1.5px solid #f4c9cd;
        color: var(--red);
        border-radius: 9px;
        font-weight: 700;
      }
      .btn-outline-danger:hover{ background: var(--red); color: #fff; }

      /* Form card wrapper */
      .form-card{
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        box-shadow: 0 16px 40px -20px rgba(20,30,60,0.18);
        padding: 28px 30px;
        max-width: 560px;
        position: relative;
        overflow: hidden;
      }
      .form-card::before{
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--blue), var(--blue-2));
      }

      img.img-thumbnail{
        border-radius: 10px;
        border: 1px solid var(--border);
        padding: 3px;
      }
    </style>
</head>
<body>

<div class="container mt-3">

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-0">
            <a class="navbar-brand" href="{{ Route::has('tentang') ? route('tentang') : url('/tentang') }}">
    <img src="{{ asset('images/logo.png') }}" alt="Logo SMKN 4">
    POS Hana
</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    @if(auth()->user()?->role?->name === 'admin')
                      <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ Route::has('admin.users') ? route('admin.users') : url('/admin/users') }}">Users</a>
                      </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('jenis') ? 'active' : '' }}" href="{{ url('/jenis') }}">jenis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" href="{{ url('/produk') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}" href="{{ url('/penjualan') }}">Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" href="{{ url('/tentang') }}">Tentang</a>
                    </li>
                </ul>

                <form method="POST" action="{{ Route::has('logout') ? route('logout') : url('/logout') }}" class="d-flex">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>