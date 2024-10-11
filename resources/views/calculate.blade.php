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
        <h1>返済スケジュール</h1>
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