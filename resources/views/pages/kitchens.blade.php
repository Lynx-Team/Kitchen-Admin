@extends('layouts.app')

@section('title', __('kitchens.title'))

@section('main')
    <div class="row justify-content-center">
        @foreach($kitchens as $kitchen)
            <div class="col">
                <a href="#" class="list-group-item list-group-item-action">
                    {{ $kitchen->name }}
                    <span class="badge badge-primary badge-pill">{{ $kitchen->order_lists_number }}</span>
                </a>
            </div>
        @endforeach
    </div>
@endsection
