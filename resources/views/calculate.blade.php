<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>借金返済シミュレーター</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card {
      margin: 20px auto;
      max-width: 600px;
    }
    .card-title {
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container">
  <a href="/register">登録画面</a>
  <div class="card shadow">
    <div class="card-body">
      <h5 class="card-title">{{ '借金返済シミュレーター' }}</h5>
      <div class="mb-3">
        <span class="fw-bold">{{ '会社名：' }}</span>
        <span id="company-name">{{ $companyName }}</span>
      </div>
      <div class="mb-3">
        <span class="fw-bold">{{ '借入金額：' }}</span>
        <span id="loan-amount">{{ $loanAmount }}</span><span>円</span>
      </div>
      <div class="mb-3">
        <span class="fw-bold">{{ '金利：' }}</span>
        <span id="interest-rate">{{ $interestRates }}</span><span>%</span>
      </div>
      <div class="mb-3">
        <span class="fw-bold">{{ '毎月の返済金額：' }}</span>
        <span id="repayment-amount">{{ $repaymentAmount }}</span><span>円</span>
      </div>
      <div class="mb-3">
        <span class="fw-bold">{{ '総額：' }}</span>
        <span id="total-amount">{{ $calculateData['totalAmount'] }}</span><span>円</span>
      </div>
      <div class="mb-3">
        <span class="fw-bold">{{ '総利息：' }}</span>
        <span id="total-interest">{{ $calculateData['totalInterest'] }}</span><span>円</span>
      </div>
      <div class="mb-3">
        <span class="fw-bold">{{ '返済期間：' }}</span>
        <span id="repayment-periods">{{ $calculateData['repaymentPeriods'] }}</span><span>ヶ月</span>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (必要なら) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- カンマ区切り用のJavaScript -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // 金額をカンマ区切りでフォーマットする関数
    function formatCurrency(amount) {
      return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // 借入金額と毎月の返済金額にカンマを追加
    var loanAmountElement = document.getElementById("loan-amount");
    var repaymentAmountElement = document.getElementById("repayment-amount");

    loanAmountElement.textContent = formatCurrency(loanAmountElement.textContent);
    repaymentAmountElement.textContent = formatCurrency(repaymentAmountElement.textContent);
  });
</script>

</body>
</html>
