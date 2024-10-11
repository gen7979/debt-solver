<!-- resources/views/partials/sidebar.blade.php -->

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px;">
    <span class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none fs-4">Sidebar</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/mypage" class="nav-link {{Request::is('mypage') ? 'active' : ''}}" aria-current="page">
                <i class="bi bi-house"></i>
                マイページ
            </a>
        </li>
        <li class="nav-item">
            <a href="/debt-register" class="nav-link {{Request::is('debt-register') ? 'active' : ''}}" aria-current="page">
                <i class="bi bi-house"></i>
                登録フォーム
            </a>
        </li>
        <li class="nav-item">
            <a href="/calculate" class="nav-link {{Request::is('calculate') ? 'active' : ''}}">
                <i class="bi bi-speedometer2"></i>
                返済スケジュール
            </a>
        </li>
    </ul>
    <hr>
</div>
