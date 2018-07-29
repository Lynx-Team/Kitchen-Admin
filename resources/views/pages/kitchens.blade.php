@extends('layouts.app')

@section('title', __('suppliers.title'))

@section('main')
    <div class="row justify-content-center">
        @for ($i = 0; $i < count($kitchens); $i++)
            <a href="#" class="list-group-item list-group-item-action">
                {{ $kitchens[$i]->name }}
                <span class="badge badge-primary badge-pill">{{ $kitchens[$i]->order_lists_number }}</span>
            </a>
        @endfor
    </div>
@endsection
