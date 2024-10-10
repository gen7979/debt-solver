<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">debt-solver</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item me-3">
                    <!-- ログアウトフォーム -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="button" class="btn btn-outline-primary"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
