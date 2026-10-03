<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DEL SARL — Gestion Documentaire & Facturation</title>

  <!-- Meta -->
  <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
  <meta name="author" content="Bootstrap Gallery" />
  <link rel="canonical" href="">
  {{-- <meta property="og:url" content="https://www.bootstrapget.com/">
  <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
  <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards"> --}}
  <meta property="og:type" content="Website">
  <meta property="og:site_name" content="Bootstrap Gallery">
  <link rel="shortcut icon" href="{{ asset('fav/favicon.ico') }}" />

  <!-- *************
			************ CSS Files *************
		************* -->
  <link rel="stylesheet" href="{{ asset('cube/assets/fonts/bootstrap/bootstrap-icons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('cube/assets/css/main.min.css') }}" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="login-bg">

  <!-- Form start -->
  <form action="{{ route('login') }}" method="POST" class="my-5">
    @csrf
    <div class="auth-box border border-dark">

      <h4 class="my-4 text-center">Se Connecter</h4>
      <div class="mb-3">
        <label class="form-label" for="name">Votre Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" autocomplete="username" placeholder="Entrer votre Email" required autofocus />
      </div>
      <div class="mb-3">
        <label class="form-label" for="pwd">Votre Mot de passe <span class="text-danger">*</span></label>
        <input type="password" name="password" class="form-control" id="pwd" autocomplete="current-password" placeholder="Entrer le mot de passe" required />
      </div>
      <div class="form-check mb-2">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Se souvenir de moi</label>
      </div>

      <div class="d-grid py-3 mt-3">
        <button type="submit" class="btn btn-lg btn-primary">
          Connectez-vous
        </button>
      </div>
      <div class="d-flex justify-content-between small">
        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
        <a href="{{ route('register') }}">Créer un compte</a>
      </div>
      @if($errors->any())
        <div class="alert alert-danger mt-3 mb-0" role="alert">{{ $errors->first() }}</div>
      @endif
      @include('layouts.flash-messages')

  </form>
  <!-- Form end -->

</body>


</html>
