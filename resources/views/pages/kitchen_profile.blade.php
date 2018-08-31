@extends('layouts.app')

@section('title', __('kitchen_profile.title'))

@section('main')
    @php($profile = $kitchenProfile)
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ $profile->kitchen->name }}</div>
                <div class="card-body">
                    <form action="{{ route('kitchen_profile.update', ['kitchen_id' => $profile->kitchen->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <input type="hidden" name="kitchen_id" value="{{ $profile->kitchen->id }}">
                        <div class="row">
                            <div class="col form-group">
                                <label for="company_name">{{ __('kitchen_profile.company_name') }}</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $profile->company_name }}">
                                @if($errors->update->has('company_name'))
                                    <p id="company_name_error" class="form-text text-danger">{{ $errors->update->first('company_name') }}</p>
                                @endif
                            </div>
                            <div class="col form-group">
                                <label for="contact_name">{{ __('kitchen_profile.contact_name') }}</label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" value="{{ $profile->contact_name }}">
                                @if($errors->update->has('contact_name'))
                                    <p id="contact_name_error" class="form-text text-danger">{{ $errors->update->first('contact_name') }}</p>
                                @endif
                            </div>
                            <div class="col form-group">
                                <label for="postal_address">{{ __('kitchen_profile.postal_address') }}</label>
                                <input type="text" class="form-control" id="postal_address" name="postal_address" value="{{ $profile->postal_address }}">
                                @if($errors->update->has('postal_address'))
                                    <p id="postal_address_error" class="form-text text-danger">{{ $errors->update->first('postal_address') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="delivery_address">{{ __('kitchen_profile.delivery_address') }}</label>
                                <input type="text" class="form-control" id="delivery_address" name="delivery_address" value="{{ $profile->delivery_address }}">
                                @if($errors->update->has('delivery_address'))
                                    <p id="delivery_address_error" class="form-text text-danger">{{ $errors->update->first('delivery_address') }}</p>
                                @endif
                            </div>
                            <div class="col form-group">
                                <label for="phone">{{ __('kitchen_profile.phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $profile->phone }}">
                                @if($errors->update->has('phone'))
                                    <p id="phone_error" class="form-text text-danger">{{ $errors->update->first('phone') }}</p>
                                @endif
                            </div>
                            <div class="col form-group">
                                <label for="delivery_instructions">{{ __('kitchen_profile.delivery_instructions') }}</label>
                                <textarea type="text" class="form-control" id="delivery_instructions" name="delivery_instructions" rows="1">{{ $profile->delivery_instructions }}</textarea>
                                @if($errors->update->has('delivery_instructions'))
                                    <p id="delivery_instructions_error" class="form-text text-danger">{{ $errors->update->first('delivery_instructions') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-2">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection