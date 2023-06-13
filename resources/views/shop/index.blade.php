@extends('layouts.master')
@section('title')
    laravel shopping cart
@endsection


@section('content')
    <div class="m-4">
        <div class="container-fluid container-lg">
            @if (Session::has('success'))
            <div class="alert alert-success  alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
                <div class="d-flex flex-row mb-3">
                    @foreach ($items as $item)
                        <div class="p-5 g-col-6">
                            <div class="thumbnail">
                                <img src="{{ $item->image_path }}" alt="..." class="img-responsive">
                                <div class="caption">
                                    <h3>{{ $item->title }}<span>${{ $item->sell_price }}</span></h3>
                                <p>{{ $item->description }}</p>
                                <div class="clearfix">
                                    <a href="{{ route('addToCart', $item->item_id) }}" class="btn btn-primary" role="button"><i class="fas fa-cart-plus"></i> Add to Cart</a> <a href="#" class="btn btn-default pull-right" role="button">
                                        <i class="fas fa-info"></i> More Info</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach                
                </div>
        </div>
        <div>{{ $items->links() }}</div>
    </div>
@endsection

