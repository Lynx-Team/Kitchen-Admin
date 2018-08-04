@extends('layouts.app')

@section('title', __('kitchens.title'))

@section('main')
        @forelse($kitchens as $kitchen)
            <div class="row justify-content-center mb-2">
                <div class="col">
                    <a href="{{ route('kitchen.view', ['kitchen_id' => $kitchen->id]) }}" class="list-group-item list-group-item-action">
                        {{ $kitchen->name }}
                        <span class="badge badge-primary badge-pill">{{ $kitchen->order_lists_number }}</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col">
                    <div class="alert alert-warning" role="alert">
                        {{ __('kitchens.empty') }}
                    </div>
                </div>
            </div>
        @endforelse
@endsection
