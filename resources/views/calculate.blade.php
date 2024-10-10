@extends('layouts.app')

@section('title', 'Home Page')
@section('content')
    <style>
        .container {
            max-width: 1000px;
        }

        .card-title {
            font-weight: bold;
        }
    </style>
    @php
        $totalData = $calculateData['totalData'];
        $viewData = $calculateData['viewData'];
        $firstTab = array_key_first($viewData);
    @endphp

    <body>
        <div class="container mt-5">
            <h1>借金返済シミュレーター</h1>
            <a href="/debt-register" class="btn btn-primary mb-3">登録画面</a>
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
                @if (empty($viewData))
                    <p>データがありません</p>
                @else
                    <ul class="nav nav-tabs" id="companyTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab-totalData-tab" data-bs-toggle="tab" href="#tab-totalData" role="tab" aria-controls="tab-totalData" aria-selected="true">
                                合計
                            </a>
                        </li>
                        @foreach($viewData as $companyName => $data)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="tab-{{ $companyName }}-tab" data-bs-toggle="tab" href="#tab-{{ $companyName }}" role="tab" aria-controls="tab-{{ $companyName }}" aria-selected="false">
                                    {{ $companyName }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="companyTabsContent">
                        {{-- 合計データ --}}
                        <div class="tab-pane fade show active" id="tab-totalData" role="tabpanel" aria-labelledby="tab-totalData-tab">
                            {{-- コンテンツ --}}
                            <div class="contents m-3">
                                @include('total-data-content')
                            </div>
                        </div>
                        {{-- 会社ごとのデータ --}}
                        @foreach($viewData as $companyName => $data)
                            <div class="tab-pane fade" id="tab-{{ $companyName }}" role="tabpanel" aria-labelledby="tab-{{ $companyName }}-tab">
                                <!-- 編集モーダル -->
                                <button type="button" class="btn btn-success m-3" data-bs-toggle="modal" data-bs-target="#editModal-{{ $companyName }}">
                                    編集
                                </button>
                                @include('edit-modal')
                                {{-- コンテンツ --}}
                                <div class="contents m-3">
                                    @include('content')
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                    <div class="card-body">
                        <!-- 編集モーダル -->
                        {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                            編集
                        </button>
                        @include('edit-modal') --}}

                        {{-- <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">{{ '会社名：' }}</label>
                            <div class="col-sm-8">
                                <span id="company-name">{{ $companyName }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">{{ '残債：' }}</label>
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
                                <span id="total-amount">{{ $totalAmount }}</span><span>円</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">{{ '総利息：' }}</label>
                            <div class="col-sm-8">
                                <span id="total-interest">{{ $totalInterest }}</span><span>円</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label fw-bold">{{ '返済期間：' }}</label>
                            <div class="col-sm-8">
                                <span id="repayment-periods">{{ $repaymentPeriods }}</span><span>ヶ月</span>
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
                                                    @foreach($repaymentSchedule as $period => $details)
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
                        </div> --}}
                    </div>
                @endif
            </div>
        </div>

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
@endsection