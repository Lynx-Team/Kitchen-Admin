@extends('layouts.app')

@section('title', __('kitchens.title'))

@section('main')
    @if(Auth::user()->can('create', \App\User::class))
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div id="kitchen_accordion">
                    <div class="card">
                        <a class="btn btn-primary" id="new_kitchen_heading" data-toggle="collapse" data-target="#new_kitchen_form" aria-expanded="true" aria-controls="new_kitchen_form" style="color: #fff;">
                            <i class="fas fa-user-plus"></i>
                            {{ __('kitchens.add_new_kitchen_title') }}
                        </a>
                        <div id="new_kitchen_form" class="collapse show" aria-labelledby="new_kitchen_heading" data-parent="#kitchen_accordion">
                            <div class="card-body">
                                <form action="{{ route('kitchens.add_new_kitchen') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.name') }}</label>
                                            <input type="text" class="form-control" name="name">
                                            @if($errors->has('name'))
                                                <p class="form-text text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.email') }}</label>
                                            <input type="email" class="form-control" name="email">
                                            @if($errors->has('email'))
                                                <p class="form-text text-danger">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.password') }}</label>
                                            <input type="password" class="form-control" name="password">
                                            @if($errors->has('password'))
                                                <p class="form-text text-danger">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.company_name') }}</label>
                                            <input type="text" class="form-control" name="company_name">
                                            @if($errors->has('company_name'))
                                                <p class="form-text text-danger">{{ $errors->first('company_name') }}</p>
                                            @endif
                                        </div>
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.contact_name') }}</label>
                                            <input type="text" class="form-control" name="contact_name">
                                            @if($errors->has('contact_name'))
                                                <p class="form-text text-danger">{{ $errors->first('contact_name') }}</p>
                                            @endif
                                        </div>
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.postal_address') }}</label>
                                            <input type="text" class="form-control" name="postal_address">
                                            @if($errors->has('postal_address'))
                                                <p class="form-text text-danger">{{ $errors->first('postal_address') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.delivery_address') }}</label>
                                            <input type="text" class="form-control" name="delivery_address">
                                            @if($errors->has('delivery_address'))
                                                <p class="form-text text-danger">{{ $errors->first('delivery_address') }}</p>
                                            @endif
                                        </div>
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.phone') }}</label>
                                            <input type="text" class="form-control" name="phone">
                                            @if($errors->has('phone'))
                                                <p class="form-text text-danger">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                        <div class="col form-group">
                                            <label>{{ __('kitchens.delivery_instructions') }}</label>
                                            <textarea class="form-control" name="delivery_instructions" rows="1"></textarea>
                                            @if($errors->has('delivery_instructions'))
                                                <p class="form-text text-danger">{{ $errors->first('delivery_instructions') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <button type="submit" class="col-3 btn btn-success mr-3">{{ __('kitchens.add_new_kitchen_btn') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @forelse($kitchens as $kitchen)
        <div class="row justify-content-center mb-2">
            <div class="card col-10">
                <div class="card-body row">
                    <div class="col-4">
                        <h5>
                            @php($kitchenProfile = \App\KitchenProfile::where('kitchen_id', $kitchen->id))
                            @if(Auth::user()->can('view', \App\KitchenProfile::class))
                                <a href="{{ route('kitchen_profile.view', ['id' => $kitchen->id]) }}">
                            @endif
                            {{ $kitchen->name }}
                            @if(Auth::user()->can('view', \App\KitchenProfile::class))
                                </a>
                            @endif
                            <span class="badge badge-primary badge-pill">Order lists: {{ $kitchen->order_lists_number }}</span>
                        </h5>
                    </div>
                    <div class="col-2">
                        @if(Auth::user()->can('view', \App\Supplier::class))
                            <a href="{{ route('suppliers.view', ['kitchen_id' => $kitchen->id]) }}" class="btn btn-primary">
                                Suppliers
                            </a>
                        @endif
                    </div>
                    <div class="col-2">
                        @if(Auth::user()->can('view', \App\Item::class))
                            <a href="{{ route('items.view', ['kitchen_id' => $kitchen->id]) }}" class="btn btn-primary">
                                Products
                            </a>
                        @endif
                    </div>
                    <div class="col-2">
                        @if(Auth::user()->can('view', \App\ItemCategory::class))
                            <a href="{{ route('item_categories.view', ['kitchen_id' => $kitchen->id]) }}" class="btn btn-primary">
                                Categories
                            </a>
                        @endif
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
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="alert alert-warning" role="alert">
                    {{ __('kitchens.empty') }}
                </div>
            </div>
        </div>
    @endforelse
@endsection
