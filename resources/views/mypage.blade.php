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
          </div>
          <div class="modal-body">
            @foreach($upcomingDebts as $debts)
                <p>返済日が近づいています：{{ $debts->repayment_day }}</p>
            @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
            <button type="button" class="btn btn-primary" id="confirmReminderBtn">確認済み</button>
          </div>
        </div>
      </div>
    </div>
  @endif
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // リロード時にモーダルを表示する
        var modalElement = document.getElementById('debtReminderModal');
        var modal = new bootstrap.Modal(modalElement);
        modal.show();

        // 確認済みボタンを押した際の非同期処理
        var confirmButton = document.getElementById('confirmReminderBtn');
        confirmButton.addEventListener('click', function() {
          // ここにクリックされた時の処理を記述
          console.log('確認済みボタンがクリックされました');
          
          // 例えば、モーダルを閉じる処理
          var modalElement = document.getElementById('debtReminderModal');
          var modal = bootstrap.Modal.getInstance(modalElement);
          modal.hide();

          // Ajaxリクエスト処理を実行
          fetch('{{ route('reminder.confirm') }}', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravelの場合、CSRFトークンが必要
              },
              body: JSON.stringify({ confirmed: true })
          }).then(response => response.json())
            .then(data => {
                console.log(data);
            });
        });
    });
  </script>
@endsection

