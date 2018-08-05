@extends('layouts.app')

@section('title', __('suppliers_view.title'))

@section('main')
    @forelse($suppliers as $supplier)
        <div class="row justify-content-center mb-2">
            <div class="col">
                <a href="{{ route('suppliers_perspective.view', ['$supplier_id' => $supplier->id]) }}" class="list-group-item list-group-item-action">
                    {{ $supplier->name }}
                </a>
            </div>
        </div>
    @empty
        <div class="row">
            <div class="col">
                <div class="alert alert-warning" role="alert">
                    {{ __('suppliers_view.empty') }}
                </div>
            </div>
        </div>
    @endforelse
@endsection
