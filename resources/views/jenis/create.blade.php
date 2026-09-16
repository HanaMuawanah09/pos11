<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Jenis</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        .card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-bottom: 25px;
            color: #2c3e50;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
        }

        input[type="text"]:focus {
            border-color: #3498db;
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 6px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 20px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Tambah Jenis</h1>

        <form action="{{ route('jenis.store') }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="nama_jenis">
                    Nama Jenis
                </label>

                <input
                    type="text"
                    id="nama_jenis"
                    name="nama_jenis"
                    value="{{ old('nama_jenis') }}"
                    placeholder="Masukkan nama jenis"
                    required
                >

                @error('nama_jenis')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="button-group">

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('jenis.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>
