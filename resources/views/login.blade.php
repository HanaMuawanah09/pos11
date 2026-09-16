<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login POS Hana</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #0b1220;
    --surface: #ffffff;
    --surface-2: #f0f3f9;
    --border: #e2e6ee;
    --blue: #2f5ce0;
    --blue-2: #4a72f0;
    --blue-deep: #16276b;
    --blue-light: #eef2ff;
    --text: #1c2333;
    --muted: #6b7385;
    --muted-2: #9aa1b0;
    --green: #1a9d6b;
    --green-bg: #e8f8f1;
    --red: #d33d47;
    --red-bg: #fdecee;
    --gold: #f2c14e;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html,body{height:100%;}
  body{
    background: var(--bg);
    color:var(--text);
    font-family:'Manrope',system-ui,sans-serif;
    display:flex;
    align-items:center;
    justify-content:center;
    min-height:100vh;
    padding:24px;
    position:relative;
    overflow:hidden;
  }

  /* Ambient background */
  body::before{
    content:'';
    position:fixed; inset:0;
    background:
      radial-gradient(1000px 700px at 15% 20%, rgba(74,114,240,0.35), transparent 60%),
      radial-gradient(900px 700px at 85% 80%, rgba(47,92,224,0.28), transparent 55%),
      radial-gradient(600px 500px at 50% 100%, rgba(22,39,107,0.5), transparent 60%),
      linear-gradient(160deg, #0b1220 0%, #0e1a33 55%, #0b1220 100%);
    z-index:0;
  }
  .grid-overlay{
    position:fixed; inset:0; z-index:0;
    background-image:
      linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
    background-size:42px 42px;
    -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, black 20%, transparent 75%);
            mask-image: radial-gradient(ellipse 80% 60% at 50% 40%, black 20%, transparent 75%);
  }
  .orb{
    position:fixed; border-radius:50%; filter:blur(2px); z-index:0; opacity:0.5;
    animation:float 9s ease-in-out infinite;
  }
  .orb-1{width:6px; height:6px; background:var(--gold); top:18%; left:22%; animation-delay:0s;}
  .orb-2{width:4px; height:4px; background:#fff; top:30%; left:78%; animation-delay:1.5s;}
  .orb-3{width:5px; height:5px; background:var(--blue-2); top:70%; left:12%; animation-delay:3s;}
  .orb-4{width:3px; height:3px; background:#fff; top:75%; left:85%; animation-delay:2s;}
  .orb-5{width:4px; height:4px; background:var(--gold); top:50%; left:6%; animation-delay:4s;}
  @keyframes float{
    0%,100%{ transform:translateY(0) translateX(0); opacity:0.35;}
    50%{ transform:translateY(-18px) translateX(6px); opacity:0.85;}
  }

  .flash{
    position:fixed; top:22px; left:50%; transform:translateX(-50%);
    display:flex; align-items:center; gap:10px;
    background:rgba(232,248,241,0.97);
    border:1px solid #c9ecdd;
    color:var(--green);
    padding:11px 20px; border-radius:10px;
    font-size:13px; font-weight:600;
    box-shadow:0 8px 24px rgba(0,0,0,0.25);
    animation:fadeDown .4s ease;
    z-index:20;
    backdrop-filter: blur(6px);
  }
  .flash.error{
    background:rgba(253,236,238,0.97);
    border:1px solid #f4c9cd;
    color:var(--red);
  }
  .flash .dot{width:6px;height:6px;border-radius:50%;background:currentColor;flex-shrink:0;}
  @keyframes fadeDown{from{opacity:0; transform:translate(-50%,-8px);} to{opacity:1; transform:translate(-50%,0);}}

  /* Layout shell */
  .shell{
    position:relative; z-index:1;
    width:100%; max-width:920px;
    display:grid;
    grid-template-columns: 1.05fr 1fr;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 40px 90px -30px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.06);
    animation:riseIn .55s cubic-bezier(.2,.7,.2,1);
  }
  @keyframes riseIn{
    from{opacity:0; transform:translateY(18px) scale(.98);}
    to{opacity:1; transform:translateY(0) scale(1);}
  }

  /* Left brand panel */
  .brand-panel{
    background:
      radial-gradient(500px 380px at 20% 10%, rgba(255,255,255,0.10), transparent 60%),
      linear-gradient(155deg, var(--blue-deep) 0%, var(--blue) 55%, var(--blue-2) 100%);
    padding:46px 40px;
    color:#fff;
    position:relative;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    min-height:560px;
  }
  .brand-panel::after{
    content:'';
    position:absolute; inset:0;
    background-image:
      linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size:34px 34px;
    -webkit-mask-image: linear-gradient(180deg, black, transparent 85%);
            mask-image: linear-gradient(180deg, black, transparent 85%);
    pointer-events:none;
  }

  .brand-top{position:relative; z-index:1;}
  .brand-mark{
    width:50px; height:50px; border-radius:13px;
    background:rgba(255,255,255,0.14);
    border:1px solid rgba(255,255,255,0.28);
    display:flex; align-items:center; justify-content:center;
    font-family:'IBM Plex Mono',monospace; font-weight:700;
    color:#fff; font-size:20px;
    backdrop-filter: blur(4px);
    margin-bottom:26px;
  }
  .brand-name{font-size:26px; font-weight:900; letter-spacing:-0.5px; line-height:1.15;}
  .brand-name span{color:var(--gold);}
  .brand-tagline{font-size:12px; color:rgba(255,255,255,0.65); text-transform:uppercase; letter-spacing:2.5px; margin-top:6px; font-weight:600;}

  .brand-pitch{
    position:relative; z-index:1;
    font-size:15px; line-height:1.65; color:rgba(255,255,255,0.82);
    max-width:340px; margin-top:38px;
    font-weight:500;
  }

  .feature-list{
    position:relative; z-index:1;
    display:flex; flex-direction:column; gap:14px;
    margin-top:32px;
  }
  .feature-item{display:flex; align-items:center; gap:12px; font-size:13px; color:rgba(255,255,255,0.88); font-weight:600;}
  .feature-icon{
    width:26px; height:26px; border-radius:8px;
    background:rgba(255,255,255,0.14);
    border:1px solid rgba(255,255,255,0.22);
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
  }
  .feature-icon svg{width:14px; height:14px; color:var(--gold);}

  .brand-bottom{
    position:relative; z-index:1;
    display:flex; align-items:center; gap:10px;
    font-size:11px; color:rgba(255,255,255,0.5); letter-spacing:0.4px;
    padding-top:24px; border-top:1px solid rgba(255,255,255,0.14);
  }
  .status-dot{width:7px; height:7px; border-radius:50%; background:#4ade80; box-shadow:0 0 0 3px rgba(74,222,128,0.25);}

  /* Right form panel */
  .form-panel{
    background:rgba(255,255,255,0.98);
    padding:46px 42px;
    display:flex;
    flex-direction:column;
    justify-content:center;
  }

  .panel-eyebrow{font-size:10.5px; color:var(--blue); text-transform:uppercase; letter-spacing:2px; font-weight:800; margin-bottom:8px;}
  .panel-title{font-size:23px; font-weight:900; letter-spacing:-0.4px; color:var(--text);}
  .panel-desc{font-size:12.5px; color:var(--muted); margin-top:6px; margin-bottom:28px;}

  .field{margin-bottom:18px;}
  .field label{
    display:block; font-size:11px; font-weight:800; color:var(--muted);
    text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;
  }
  .input-shell{position:relative; display:flex; align-items:center;}
  .input-shell svg{position:absolute; left:13px; width:16px; height:16px; color:var(--muted-2); pointer-events:none;}
  .input-shell input{
    width:100%; background:var(--surface-2); border:1.5px solid var(--border);
    border-radius:10px; padding:12.5px 14px 12.5px 38px; color:var(--text);
    font-family:'Manrope'; font-size:13.5px; outline:none; transition:.15s;
  }
  .input-shell input::placeholder{color:var(--muted-2);}
  .input-shell input:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 4px rgba(47,92,224,0.12);
    background:#fff;
  }
  .input-shell.has-error input{border-color:var(--red);}
  .field-error{color:var(--red); font-size:11.5px; margin-top:6px; font-weight:600;}

  .toggle-eye{position:absolute; right:12px; width:16px; height:16px; color:var(--muted-2); cursor:pointer;}
  .toggle-eye:hover{color:var(--blue);}

  .row-between{display:flex; align-items:center; justify-content:space-between; margin-bottom:22px;}
  .remember{display:flex; align-items:center; gap:8px; font-size:12.5px; color:var(--muted); font-weight:500;}
  .remember input{width:14px; height:14px; accent-color:var(--blue);}

  .submit-btn{
    width:100%; padding:13px; border:none; border-radius:10px;
    background:linear-gradient(135deg, var(--blue) 0%, var(--blue-2) 100%);
    color:#fff; font-family:'Manrope'; font-weight:800; font-size:14px;
    letter-spacing:0.2px; cursor:pointer;
    box-shadow:0 14px 28px -10px rgba(47,92,224,0.55); transition:.18s;
    display:flex; align-items:center; justify-content:center; gap:8px;
  }
  .submit-btn:hover{filter:brightness(1.08); transform:translateY(-1px); box-shadow:0 18px 32px -10px rgba(47,92,224,0.6);}
  .submit-btn:active{transform:translateY(0);}
  .submit-btn svg{width:15px; height:15px;}

  .divider-note{
    text-align:center; font-size:11px; color:var(--muted-2); margin-top:22px; letter-spacing:0.3px;
    display:flex; align-items:center; gap:10px;
  }
  .divider-note::before, .divider-note::after{content:''; flex:1; height:1px; background:var(--border);}

  .foot-note{text-align:center; font-size:11px; color:var(--muted-2); margin-top:24px; letter-spacing:0.5px;}
  .foot-note b{color:var(--muted);}

  @media (max-width: 760px){
    .shell{grid-template-columns:1fr;}
    .brand-panel{min-height:0; padding:34px 28px;}
    .feature-list{display:none;}
    .form-panel{padding:34px 26px;}
  }
</style>
</head>
<body>

<div class="grid-overlay"></div>
<span class="orb orb-1"></span>
<span class="orb orb-2"></span>
<span class="orb orb-3"></span>
<span class="orb orb-4"></span>
<span class="orb orb-5"></span>

@if (session('success'))
  <div class="flash"><span class="dot"></span>{{ session('success') }}</div>
@endif

@if ($errors->any())
  <div class="flash error"><span class="dot"></span>{{ $errors->first() }}</div>
@endif

<div class="shell">

  {{-- ===== Left / brand panel ===== --}}
  <div class="brand-panel">
    <div class="brand-top">
      <div class="brand-mark">H</div>
      <div class="brand-name">POS <span>Hana</span></div>
      <div class="brand-tagline">Point of Sale System</div>

      <p class="brand-pitch">
        Kelola penjualan, stok, dan laporan harian dalam satu dashboard yang cepat, rapi, dan mudah dipakai.
      </p>

      <div class="feature-list">
        <div class="feature-item">
          <span class="feature-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>
          </span>
          Transaksi &amp; kasir real-time
        </div>
        <div class="feature-item">
          <span class="feature-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>
          </span>
          Pemantauan stok otomatis
        </div>
        <div class="feature-item">
          <span class="feature-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>
          </span>
          Laporan penjualan harian
        </div>
      </div>
    </div>

    <div class="brand-bottom">
      <span class="status-dot"></span>
      Sistem aktif &amp; siap digunakan
    </div>
  </div>

  {{-- ===== Right / form panel ===== --}}
  <div class="form-panel">
    <div class="panel-eyebrow">Selamat datang kembali</div>
    <div class="panel-title">Masuk ke akun Anda</div>
    <div class="panel-desc">Silakan masukkan kredensial untuk melanjutkan.</div>

    <form action="{{ route('auth') }}" method="POST">
      @csrf

      <div class="field">
        <label>Email Address</label>
        <div class="input-shell {{ $errors->has('email') ? 'has-error' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
          <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" autofocus>
        </div>
        @error('email')
          <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="field">
        <label>Password</label>
        <div class="input-shell {{ $errors->has('password') ? 'has-error' : '' }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg>
          <input type="password" name="password" id="passwordInput" placeholder="••••••••">
          <svg class="toggle-eye" onclick="togglePassword()" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
        </div>
        @error('password')
          <div class="field-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="row-between">
        <label class="remember">
          <input type="checkbox" name="remember">
          Ingat saya
        </label>
      </div>

      <button type="submit" class="submit-btn">
        Masuk
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </button>
    </form>

    <div class="divider-note">Akses terbatas</div>

    <div class="foot-note">© 2026 <b>POS Hana</b> — Internal System</div>
  </div>

</div>

<script>
function togglePassword(){
  const input = document.getElementById('passwordInput');
  input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

</body>
</html>