@extends('layouts.application')

@section('title'){{ getTitle() }}@endsection
@section('description'){{ getDescription() }}@endsection

@section('content')
    @if(count($promotions))

        @foreach($promotions as $promotion)
            <div class="container">
                <div class="jumbotron">
                    <h3>{{ $promotion->title }}</h3>
                    <span>{{ $promotion->content }}</span>
                </div>
            </div>
        @endforeach
    @endif
@endsection

