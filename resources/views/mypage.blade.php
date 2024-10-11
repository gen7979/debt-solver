@extends('layouts.app')

@section('title', 'Home Page')
@section('content')
  <h1>マイページ</h1>
  @if(isset($upcomingDebts))
    <div class="modal fade" id="debtReminderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">返済リマインダー</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @foreach($upcomingDebts as $debts)
                <p>返済日が近づいています：{{ $debts->repayment_day }}</p>
            @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="button" class="btn btn-primary" id="confirmReminderBtn">確認済み</button>
          </div>
        </div>
      </div>
    </div>
  @endif
  <script>
    // リロード時にモーダルを表示する
    document.addEventListener('DOMContentLoaded', function() {
        var modalElement = document.getElementById('debtReminderModal');
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
    });
  </script>  
@endsection

