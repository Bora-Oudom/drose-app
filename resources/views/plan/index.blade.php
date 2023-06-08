@extends('layouts.app')
@section('content')
    <h1 class="plan-title">Pricing Table</h1>
    <div class="plan-container">
        @foreach ($plans as $plan)
            <div class="price-table">
                <div class="price first">
                    <span>{{ $plan->name }}</span>
                    <span>$ <span class="sp-price">{{ $plan->price }}</span></span>
                    <span>1 month</span>
                </div>
                <ul>
                    <li>
                        <i class="fa-solid fa-circle-check fa-lg"></i>
                        <div class="text">
                            <span>Resoltion</span>
                            <br>
                            720p(HD)
                        </div>
                    </li>
                    <li><i class="fa-solid fa-circle-check fa-lg"></i>
                        <div class="text">
                            <span>Video qulity</span>
                            <br>
                            Good
                        </div>
                    </li>
                    <li><i class="fa-solid fa-circle-check fa-lg"></i>
                        <div class="text">
                            <span>Supported devices</span>
                            <br>
                            TV, computer, mobile phone, tablet
                        </div>
                    </li>

                </ul>
                <a class="btn button" href="{{ route('plans.show', $plan->slug) }}">Purchase</a>
            </div>
        @endforeach
    </div>
@endsection
