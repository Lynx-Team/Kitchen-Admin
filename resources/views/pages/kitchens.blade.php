@extends('layouts.app')

@section('title', __('kitchens.title'))

@section('main')
        @forelse($kitchens as $kitchen)
            <div class="row justify-content-center mb-2">
                <div class="card col-10">
                    <div class="card-body row">
                        <div class="col-8">
                            <h5>
                                {{ $kitchen->name }}
                                <span class="badge badge-primary badge-pill">Order lists: {{ $kitchen->order_lists_number }}</span>
                            </h5>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('items.view', ['kitchen_id' => $kitchen->id]) }}" class="btn btn-primary">
                                Products
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="{{ route('view_order_lists.view', ['kitchen_id' => $kitchen->id]) }}" class="btn btn-success">
                                View
                            </a>
                        </div>
                    </div>
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
