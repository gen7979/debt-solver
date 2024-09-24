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

<div class="container mt-5">
    <a href="/register" class="btn btn-primary mb-3">登録画面</a>
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title text-center mb-4">{{ '借金返済シミュレーター' }}</h5>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label fw-bold">{{ '会社名：' }}</label>
                <div class="col-sm-8">
                    <span id="company-name">{{ $companyName }}</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label fw-bold">{{ '借入金額：' }}</label>
                <div class="col-sm-8">
                    <span id="loan-amount">{{ $loanAmount }}</span><span>円</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label fw-bold">{{ '金利：' }}</label>
                <div class="col-sm-8">
                    <span id="interest-rate">{{ $interestRates }}</span><span>%</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label fw-bold">{{ '毎月の返済金額：' }}</label>
                <div class="col-sm-8">
                    <span id="repayment-amount">{{ $repaymentAmount }}</span><span>円</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label fw-bold">{{ '総額：' }}</label>
                <div class="col-sm-8">
                    <span id="total-amount">{{ $calculateData['totalAmount'] }}</span><span>円</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label fw-bold">{{ '総利息：' }}</label>
                <div class="col-sm-8">
                    <span id="total-interest">{{ $calculateData['totalInterest'] }}</span><span>円</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label fw-bold">{{ '返済期間：' }}</label>
                <div class="col-sm-8">
                    <span id="repayment-periods">{{ $calculateData['repaymentPeriods'] }}</span><span>ヶ月</span>
                </div>
            </div>

            <div class="mb-3">
                <span class="fw-bold">{{ '返済スケジュール：' }}</span>
                <div class="accordion" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                返済スケジュールを表示
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>期間</th>
                                            <th>返済金額</th>
                                            <th>利息</th>
                                            <th>残高</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($calculateData['repaymentSchedule'] as $period => $details)
                                        <tr>
                                            <td>{{ $period }}</td>
                                            <td>{{ $details['repaymentAmount'] }}</td>
                                            <td>{{ $details['interestAmount'] }}</td>
                                            <td>{{ $details['remainingBalance'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }
  </script>

</body>

</html>
