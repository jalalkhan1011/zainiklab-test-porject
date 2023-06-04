@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @php $user = Auth::user(); @endphp
                        @if ($user->user_type == 'Admin')
                            {{ __('You are logged in as a admin!') }}
                            <h4>{{ __('All User Information') }}</h4>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Staus') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach ($customerInfos as $customerInfo)
                                        <tr>
                                            <th scope="row">{{ ++$i }}</th>
                                            <td>{{ __($customerInfo->name ?? '') }}</td>
                                            <td>{{ __($customerInfo->email ?? '') }}</td>
                                            <td>{{ __($customerInfo->status ?? '') }}</td>
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <form action="{{ route('disableCustomer') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" class="form-control" name="custome_id"
                                                                value="{{ $customerInfo->id }}">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary text-white">{{ __('Disable') }}</button>
                                                        </form>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <form action="{{ route('customers.destroy', $customerInfo->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" class="form-control" name="custome_id"
                                                                value="{{ $customerInfo->id }}">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger text-white">{{ __('Remove') }}</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $customerInfos->links() }} 
                        @else
                            {{ __('You are logged in as a user!') }}
                            <p>{{ __('Your link is '.'= '. 'http://127.0.0.1:8000/'.''.$customerInfos->link ?? '') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
