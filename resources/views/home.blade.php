@extends('layouts.master')

@section('pageTitle', 'Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in as:
                    {{ Auth::user()->name_first }}
                    {{ Auth::user()->name_last }}

                        <form action="/users/{{ Auth::user()->id }}" aria-label="{{ __('User profile') }}"
                              method="POST" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <input id="id" name="id" value="{{ Auth::user()->id }}" type="hidden">

                            <div class="form-group row">

                                <div class="col-md-6">
                                    <img id="profile_image" src="{{ asset(Auth::user()->profile) }}" height="300">
                                    <input type="file" id="profile" name="profile" style="display:none;" accept="image/*"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text"
                                           class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}"
                                           name="company" value="{{ Auth::user()->company }}" autofocus>

                                    @if ($errors->has('company'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name_first"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name_first" type="text"
                                           class="form-control{{ $errors->has('name_first') ? ' is-invalid' : '' }}"
                                           name="name_first" value="{{ Auth::user()->name_first }}">

                                    @if ($errors->has('name_first'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_first') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name_last"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="name_last" type="text"
                                           class="form-control{{ $errors->has('name_last') ? ' is-invalid' : '' }}"
                                           name="name_last" value="{{ Auth::user()->name_last }}">

                                    @if ($errors->has('name_last'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_last') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telNum"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Cell Number') }}</label>

                                <div class="col-md-6">
                                    <input id="telNum" type="text"
                                           class="form-control{{ $errors->has('telNum') ? ' is-invalid' : '' }}"
                                           name="telNum" value="{{ Auth::user()->telNum }}">

                                    @if ($errors->has('telNum'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telNum') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ Auth::user()->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                            <!--  Error handle -->
                            @if($errors->any())

                                <ul class="alert-box warning radius">
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>

                            @endif


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- allows clicking the visible image to "click" the hidden file upload -->
    <script src="{{ asset('/js/imageUpload.js') }}"></script>

@endsection
