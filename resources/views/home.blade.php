@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>


            <form method="POST" action="{{ route('paypal') }}">
                @csrf
                <input type="text" name="price" value="5">
                <input type="text" name="product_name" value="book">
                <input type="text" name="quantity" value="1">
                <button type="submit" class="btn btn-primary">
                    {{ __('pay') }}
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
