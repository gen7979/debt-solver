<!-- resources/views/partials/sidebar.blade.php -->

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/debt-register" class="nav-link active" aria-current="page">
                <i class="bi bi-house"></i>
                登録フォーム
            </a>
        </li>
        <li class="nav-item">
            <a href="/calculate" class="nav-link link-dark">
                <i class="bi bi-speedometer2"></i>
                返済スケジュール
            </a>
        </li>
    </ul>
    <hr>
</div>
