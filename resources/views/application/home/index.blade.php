@extends('layouts.application')

@section('title'){{ getTitle() }}@endsection
@section('description'){{ getDescription() }}@endsection

@section('content')

    @include('partials.common.games')


@endsection