@extends('layouts.main')
@section('content')
    <style>
        .not-found {
            font-size: 40px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-5 not-found">404</div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-auto mt-5 not-found">{{ trans('short_link.not_found') }}</div>
        </div>
    </div>
@endsection
