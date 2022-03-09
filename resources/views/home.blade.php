@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($products as $product)
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-header bg-white">{{ $product->name }}</div>

                    <div class="card-body">
                       <div> <img height="100" src="{{ $product->image }}" /> </div>
                       <div class="mt-4">
                           @if($product->inStock())
                               <span class="text-success">In Stock ( {{ $product->quantity }} )</span>
                           @else
                               <span class="text-danger">Out of stock</span>
                           @endif
                       </div>
                       <div class="mt-2">
                           <form method="POST" action="{{ route('cart.add') }}">
                               @csrf
                               <input type="hidden" name="product_id" value="{{ $product->id }}">
                               <button class="btn btn-primary">Add to cart</button>
                           </form>
                       </div>
                       @php // {{ $products->links() }} just leaving this here @endphp
                    </div> 
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
