@extends('layouts.app')

@section('title', __('reporting.title'))

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('reporting.days_to_keep') }}</div>
                <div class="card-body">
                    <form action="{{ route('reporting.update_days_to_keep') }}" method="POST" class="row justify-content-center">
                        @csrf
                        <div class="col-4 form-group">
                            <label>{{ __('reporting.days_to_keep') }}</label>
                            <input type="number" class="form-control" name="days_to_keep" min="1" value="{{ $days_to_keep }}">
                            @if($errors->has('days_to_keep'))
                                <p class="form-text text-danger">{{ $errors->first('days_to_keep') }}</p>
                            @endif
                        </div>
                        <div class="col-2">
                            <label>&nbsp;</label>
                            <button type="submit" class="form-control btn btn-warning">{{ __('reporting.update_days_btn') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('reporting.choose_interval') }}</div>
                <div class="card-body">
                    <form action="#" method="POST" class="row">
                        @csrf
                        <div class="col form-group">
                            <label>{{ __('reporting.start_date') }}</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col form-group">
                            <label>{{ __('reporting.end_date') }}</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <div class="col form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="form-control btn btn-primary">{{ __('reporting.show_reports') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(count($reports) !== 0)
                <div class="list-group">
                    @foreach($reports as $report)
                        <a href="{{ route('reporting_items.view', ['kitchen_id' => Request::segment(2), 'report_id' => $report->id]) }}" class="list-group-item list-group-item-action">
                            {{ $report->note }}
                            <span class="badge badge-pill badge-info">
                                {{ $report->last_update_date }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    {{ __('reporting.no_reports') }}
                </div>
            @endif
        </div>
    </div>
@endsection
