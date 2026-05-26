<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Aplikasi Web</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm mt-5">
          <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Form Login</h4>
          </div>
          <div class="card-body">
            @if (session('msg'))
              <div class="alert alert-danger text-center">{{ session('msg') }}</div>
            @endif

            <form method="POST" action="{{ route('auth') }}">
              @csrf

              <div class="mb-3">
                <label for="em" class="form-label">Email Address</label>
                <input type="email" name="em" id="em" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" name="pwd" id="pwd" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>