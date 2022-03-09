@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @foreach($items as $item)
            <div class="col-12 mt-4">
                <div class="d-flex align-items-center justify-content-between">
                  
                    <div class="d-flex align-items-center">
                        <div>{{ $item->quantity }}x  {{ $item->product->name }}</div>
                        <img src="{{ $item->product->image }}" height="50" width="50" class="ml-2" alt="">
                    </div>

                    <div>
                      <div class="fw-bold">
                        $ {{ $item->finalPrice() }}
                      </div>
                      @if(session()->has('coupon_discount'))
                         <div><small><i>{{ session('coupon_discount') }}% discount applied</i></small></div>
                      @endif
                    </div>

                </div>
            </div>
        @endforeach

        <div class="fw-bold col-12 d-flex justify-content-end">
            <div class="h3">Total: ${{ $total }}</div>
        </div>
    </div>

    <div class="row">
       @auth
           <div class="col-lg-4">
             @include('coupons')
             <hr>
           </div>
       @endauth
      <div class="col-12">
        <form method="POST" action="{{ route('checkout') }}">
           @csrf
           @include('address_fields')
           <button class="btn btn-primary">Complete Checkout</button>
        </form>
      </div>
    </div>

</div>
@endsection
