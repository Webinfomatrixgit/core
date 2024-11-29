@extends('frontend.layouts.user.app')
@push('style')
    <style>
        .wallet-container {
            background-color: #007bff; /* Solid color for simplicity */
            border-radius: 8px; /* Slightly softer corners */
            padding: 12px 16px; /* Compact padding */
            font-size: 14px; /* Small, readable text */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Subtle shadow */
        }

        .wallet-container .fa-wallet {
            color: #fff; /* Keep icon matching the text */
        }

        .wallet-text {
            font-size: 14px;
        }

        .wallet-amount {
            font-size: 18px;
            color: #ffeb3b; /* Highlight the balance */
        }

        /* Responsiveness */
        @media (max-width: 576px) {
            .wallet-container {
                flex-direction: column;
                text-align: center;
            }
            .wallet-amount {
                margin-top: 8px;
                font-size: 16px;
            }
        }
    </style>
@endpush
@section('user-content')
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <div class="list-group list-group-transparent">
                        <a href="{{ route('user.article') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('article') }}">
                            <i class="fa-regular fa-shield-check me-2"></i>
                            {{ __('PR List') }}
                        </a>
                    </div>
                    <div class="list-group list-group-transparent">
                        <a href="{{ route('user.article.create') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('article') }}">
                            <i class="fa-regular fa-shield-check me-2"></i>
                            {{ __('PR Add') }}
                        </a>
                    </div>
                    <div class="list-group list-group-transparent">
                        <a href="{{ route('user.company') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('article') }}">
                            <i class="fa-regular fa-shield-check me-2"></i>
                            {{ __('Company') }}
                        </a>
                    </div>
                    <div class="list-group list-group-transparent">
                        <a href="{{ route('user.company.create') }}"
                           class="list-group-item list-group-item-action d-flex align-items-center {{ isActive('article') }}">
                            <i class="fa-regular fa-shield-check me-2"></i>
                            {{ __('Add Company') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column">
                @yield('user-article-content')
            </div>
        </div>
    </div>
@endsection
