@extends('layouts.app')

@section('title', 'Home Page')
@section('content')
  <body>
    <h1>登録フォーム</h1>
    <div class="container mt-5">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <div class="card shadow-lg">
        <!-- 入力フォーム -->
        <form method="post" action="{{ url('/debt-register') }}">
          @csrf
          <!-- 会社名 -->
          <div class="m-3">
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
          <div class="m-3">
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
          <div class="m-3">
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
          <div class="m-3">
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
          <div class="m-3">
            <label for="repayment_day" class="form-label">返済日(日)</label>
            <input
              type="number"
              class="form-control"
              id="repayment_day"
              name="repayment_day"
              placeholder="返済日を入力してください（日付のみ）"
            >
          </div>
          <button type="submit" class="btn btn-primary m-3">登録</button>
        </form>
    </div>  
  </body>
@endsection