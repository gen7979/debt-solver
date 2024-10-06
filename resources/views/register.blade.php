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

  <!-- 入力フォーム -->
  <form method="post" action="{{ url('/calculate') }}">
    @csrf
    <!-- 会社名 -->
    <div class="mb-3">
      <label for="company" class="form-label">会社名</label>
      <input
        type="text"
        class="form-control"
        id="company"
        name="company"
        placeholder="借金をしている会社名を入力してください（匿名可能）"
      >
    </div>
    <!-- 借入金額 -->
    <div class="mb-3">
      <label for="loanAmount" class="form-label">残債（円）</label>
      <input
        type="number"
        class="form-control"
        id="loanAmount"
        name="loanAmount"
        placeholder="上で入力した会社から借りている金額を入力してください"
      >
    </div>
    <!-- 金利 -->
    <div class="mb-3">
      <label for="interestRates" class="form-label">利息（%）</label>
      <input
        type="number"
        step="0.01"
        class="form-control"
        id="interestRates"
        name="interestRates"
        placeholder="利息を入力してください"
      >
    </div>
    <!-- 返済金額 -->
    <div class="mb-3">
      <label for="repaymentAmount" class="form-label">毎月の返済金額（円）</label>
      <input
        type="number"
        class="form-control"
        id="repaymentAmount"
        name="repaymentAmount"
        placeholder="毎月の返済金額を入力してください"
      >
    </div>
    <button type="submit" class="btn btn-primary">登録</button>
  </form>
</body>
