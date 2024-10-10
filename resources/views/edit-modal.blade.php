<!-- モーダル本体 -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">編集</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('debt-register.update', $id) }}" method="POST">
      @csrf
      @method('PUT')
          <div class="modal-body">
            <div class="mb-3">
                <label for="company_name" class="form-label">会社名</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $companyName }}">
            </div>
            <div class="mb-3">
                <label for="remaining_amount" class="form-label">残債</label>
                <input type="number" class="form-control" id="remaining_amount" name="remaining_amount" value="{{ $loanAmount }}">
            </div>
            <div class="mb-3">
                <label for="interest_rate" class="form-label">利率</label>
                <input type="number" class="form-control" id="interest_rate" name="interest_rate" value="{{ $interestRates }}">
            </div>
            <div class="mb-3">
                <label for="repayment_amount" class="form-label">返済額</label>
                <input type="number" class="form-control" id="repayment_amount" name="repayment_amount" value="{{ $repaymentAmount }}">
            </div>
            <div class="mb-3">
                <label for="repayment_day" class="form-label">返済日</label>
                <input type="number" class="form-control" id="repayment_day" name="repayment_day" value="{{ $repaymentDay }}">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary">保存</button>
          </div>
      </form>
    </div>
  </div>
</div>
