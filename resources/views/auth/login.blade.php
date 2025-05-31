<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  
</head>
<body>
  <div class="login-wrapper">
    <div class="login-left">
      <h2>Connexion</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        @method("post")
        @if($errors->any())
          @foreach($errors->all() as $err)
            <div style="color: red;">{{$err}}</div>
          @endforeach
        @endif
        <input type="email" value="{{old("email")}}" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
      </form>
    </div>

    <div class="login-right">
      <!-- Optional: we can add text, logo, or leave it as a nice image -->
            <div class="sparkle"></div>
            <div class="sparkle"></div>
            <div class="sparkle"></div>
    </div>
  </div>
</body>
</html>