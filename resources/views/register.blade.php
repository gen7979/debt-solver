<head>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">
  <!-- ログアウトフォーム -->
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="button" class="btn btn-outline-primary"
            onclick="event.preventDefault(); this.closest('form').submit();">
      {{ __('Log Out') }}
    </button>
  </form>

  <form method="GET" action="{{ route('calculate') }}">
    @csrf
    <button type="button" class="btn btn-outline-primary"
            onclick="event.preventDefault(); this.closest('form').submit();">
      マイページ
    </button>
  </form>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <!-- 入力フォーム -->
  <form method="post" action="{{ url('/debt-register') }}">
    @csrf
    <!-- 会社名 -->
    <div class="mb-3">
      <label for="company_name" class="form-label">会社名</label>
      <input
        type="text"
        class="form-control"
        id="company_name"
        name="company_name"
        placeholder="借金をしている会社名を入力してください（匿名可能）"
      >
    </div>
    <!-- 残債 -->
    <div class="mb-3">
      <label for="remaining_amount" class="form-label">残債（円）</label>
      <input
        type="number"
        class="form-control"
        id="remaining_amount"
        name="remaining_amount"
        placeholder="上で入力した会社から借りている金額を入力してください"
      >
    </div>
    <!-- 金利 -->
    <div class="mb-3">
      <label for="interest_rate" class="form-label">利率（%）</label>
      <input
        type="number"
        step="0.01"
        class="form-control"
        id="interest_rate"
        name="interest_rate"
        placeholder="利息を入力してください"
      >
    </div>
    <!-- 毎月の返済金額 -->
    <div class="mb-3">
      <label for="repayment_amount" class="form-label">毎月の返済金額（円）</label>
      <input
        type="number"
        class="form-control"
        id="repayment_amount"
        name="repayment_amount"
        placeholder="毎月の返済金額を入力してください"
      >
    </div>
    <!-- 返済日 -->
    <div class="mb-3">
      <label for="repayment_day" class="form-label">返済日(日)</label>
      <input
        type="number"
        class="form-control"
        id="repayment_day"
        name="repayment_day"
        placeholder="返済日を入力してください（日付のみ）"
      >
    </div>
    <button type="submit" class="btn btn-primary">登録</button>
  </form>
</body>
