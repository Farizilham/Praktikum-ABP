<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - Aplikasi Web</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('products.index') }}">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item me-2">
            <a class="nav-link text-white" href="{{ route('products.index') }}">Daftar Produk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-danger btn-sm text-white px-3" href="{{ route('logout') }}"
              onclick="return confirm('Apakah Anda yakin ingin keluar?')">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-3">
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>