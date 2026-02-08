<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Calon Siswa - PMBM MAN 1 Tegal</title>
    <meta name="description" content="Login Calon Siswa PMBM MAN 1 Tegal">
    <meta name="keywords" content="Login Calon Siswa PMBM MAN 1 Tegal">
    <meta name="author" content="PMBM">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/logo_kemenag.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-green-600 px-8 py-6 text-center">
            <h1 class="text-white text-2xl font-bold">Login Siswa</h1>
            <p class="text-green-100 text-sm mt-1">Masuk untuk cek status & cetak formulir</p>
        </div>

        <div class="p-8">
            <form action="{{ route('casis.login.post') }}" method="POST">
                @csrf

                @if($errors->any())
                <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
                    {{ $errors->first() }}
                </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">NISN</label>
                    <input type="text" name="nisn"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="Masukkan NISN">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        placeholder="********">
                    <p class="text-xs text-gray-400 mt-1">Default: NISN + 2 digit tanggal daftar (misal: 123456789005)
                    </p>
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-green-500/30 transition transform hover:-translate-y-0.5">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('landing') }}" class="text-sm text-gray-500 hover:text-green-600">Kembali ke
                    Beranda</a>
            </div>
        </div>
    </div>

</body>

</html>