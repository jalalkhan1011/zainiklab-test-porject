@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Customer Infomation') }}</div>

                    <div class="card-body"> 
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }} </label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $customerInfo->name }}" required autocomplete="name" autofocus readonly> 
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }} <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $customerInfo->email  }}" required autocomplete="email" readonly>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="details"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Details') }} <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <textarea id="details" class="form-control @error('details') is-invalid @enderror" name="details" required readonly>{{ $customerInfo->details }}</textarea>

                                    @error('details')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="avater"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Avater') }} <span class="text-danger">*</span></label>

                                <div class="col-md-6"> 
                                        <img src="{{ !empty($customerInfo->avater) ? asset('upload/'.$customerInfo->avater) : asset('backend/project/images/avatar/user-avatar.jpg') }}" width="100" height="100" alt="">
                                </div>
                            </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
