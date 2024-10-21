@extends('layouts.app')

@section('title', 'Home Page')
@section('content')
  <h1>マイページ</h1>
  @if($upcomingDebts != [])
    <div class="modal fade" id="debtReminderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">返済リマインダー</h5>
          </div>
          <div class="modal-body">
            <p>以下の返済はお済みですか？</p><br>
            @foreach($upcomingDebts as $companyName => $data)
              <p class="fw-bolder">{{ $companyName }}</p>
              @foreach ($data as $dateYm => $data)
                <p>{{ $dateYm . $data['repaymentDay'] . '日' }}</p>
                <p>{{ $data['repaymentAmount'] . '円' }}</p>                  
              @endforeach
            @endforeach
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">未返済</button>
            <button type="button" class="btn btn-primary" id="confirmReminderBtn">返済済み</button>
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

        // 確認済みボタンを押した際の処理
        var confirmButton = document.getElementById('confirmReminderBtn');
        confirmButton.addEventListener('click', function() {          
          // モーダルを閉じる処理
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

