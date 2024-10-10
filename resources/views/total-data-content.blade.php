<div class="mb-3 row">
    <label class="col-sm-4 col-form-label fw-bold">{{ '残債：' }}</label>
    <div class="col-sm-8">
        <span id="loan-amount">{{ $totalData['loanAmount'] }}</span><span>円</span>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-4 col-form-label fw-bold">{{ '毎月の返済金額：' }}</label>
    <div class="col-sm-8">
        <span id="repayment-amount">{{ $totalData['repaymentAmount'] }}</span><span>円</span>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-4 col-form-label fw-bold">{{ '総額：' }}</label>
    <div class="col-sm-8">
        <span id="total-amount">{{ $totalData['totalAmount'] }}</span><span>円</span>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-4 col-form-label fw-bold">{{ '総利息：' }}</label>
    <div class="col-sm-8">
        <span id="total-interest">{{ $totalData['totalInterest'] }}</span><span>円</span>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-sm-4 col-form-label fw-bold">{{ '返済期間：' }}</label>
    <div class="col-sm-8">
        <span id="repayment-periods">{{ $totalData['repaymentPeriods'] }}</span><span>ヶ月</span>
    </div>
</div>
<div class="mb-3">
    <div class="accordion mt-3" id="accordionFlushExample">
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
                                <th>残債</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($totalData['repaymentSchedule'] as $period => $details)
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
