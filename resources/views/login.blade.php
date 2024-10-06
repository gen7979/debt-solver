<html>
  <head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <h1>Login Page</h1>
    @if (Route::has('login'))
      <nav class="-mx-3 flex flex-1 justify-end">
        @auth
          <form action="{{ route('debt-register') }}">
            @csrf
            <button type="submit" class="btn btn-outline-primary">
              借金計算
            </button>
          </form>
        @else
          <form action="{{ route('login') }}">
            @csrf
            <button type="submit" class="btn btn-outline-primary">
              ログイン
            </button>
          </form>
          @if (Route::has('register'))
            <form action="{{ route('register') }}">
              @csrf
              <button type="submit" class="btn btn-outline-primary">
                新規登録
              </button>
            </form>
          @endif
        @endauth
      </nav>
    @endif
  </body>
</html>
