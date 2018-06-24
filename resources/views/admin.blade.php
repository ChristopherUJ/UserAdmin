@extends('layouts.master')

@section('pageTitle', 'Admin')

@section('content')

    <div class="container">
        <table class="table table-bordered">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>E-mail address</th>
            <th>Telephone number</th>
            <th>Company</th>
            <th>Edit</th>
            <th>Mail</th>
            <th>Delete</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="data-row">
                    <td class="id">{{ $user->id }}</td>
                    <td class="name_first">{{ $user->name_first }}</td>
                    <td class="name_last">{{ $user->name_last }}</td>
                    <td class="email">{{ $user->email }}</td>
                    <td class="telNum">{{ $user->telNum }}</td>
                    <td class="company">{{ $user->company }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" id="edit-item" data-item-id="{{ $user->id }}">
                            Edit
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" id="mail-item" data-item-id="{{ $user->id }}">
                            Mail
                        </button>
                    </td>
                    <td>
                        <!-- Inline form to delete user
                        Logged in Admin user can't delete self -->
                        @if($user->id != Auth::user()->id)
                            <form id="userDeleteForm/{{ $user->id }}" action="/users/{{ $user->id }}" aria-label="{{ __('User profile') }}"
                                  method="POST">
                                {{ method_field('DELETE') }}
                                @csrf
                                <input id="deleteUser_{{ $user->id }}" name="deleteUser_{{ $user->id }}"
                                       value="{{ $user->id }}" type="hidden">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Edit Modal -->
        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="attachment-body-content">
                        <form id="userUpdateForm" action="/users/" aria-label="{{ __('User profile') }}"
                              method="POST" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="form-group row">
                                <label for="company"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text"
                                           class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}"
                                           name="company" autofocus>

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
                                           name="name_first">

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
                                           name="name_last">

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
                                           name="telNum">

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
                                           name="email" required>

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
        <!-- /Edit Modal -->

        <!-- Email  modal -->

        <div class="modal fade" id="mail-modal" tabindex="-1" role="dialog" aria-labelledby="mail-modal-label"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mail-modal-label">Email Body</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="attachment-body-content">
                        <form id="emailForm" action="/sendMail/" aria-label="{{ __('User profile') }}"
                              method="POST" enctype="multipart/form-data">

                            @csrf

                            <textarea name="emailBody" id="emailBody" autofocus>

                            </textarea>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Mail') }}
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

        <!-- /Email modal -->

    </div>

    <!-- JavaScript to call and populate modals for update and email -->
    <script src="{{ asset('js/adminModals.js') }}"></script>

@endsection