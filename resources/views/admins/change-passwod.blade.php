
@extends('layouts.app')

@section('content')
    <style>
        .error {
            color: red;
            /* background-color: #acf; */
        }
    </style>
    <section class="content-header">
        <h1>
            Change Password
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <form method="POST" id="passwordChangeForm" action="{{ route('change.passwod.action') }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" placeholder="Current Password"
                                id="current_password" class="form-control @error('current_password') is-invalid @enderror"
                                required>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" placeholder="New Password" id="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm New Password"
                                id="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div> 
    {{-- validate plugin --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" defer></script>
    
    <script>
        $(document).ready(function() {
            $("#passwordChangeForm").validate({
                rules: {
                    current_password: {
                        required: true,
                        minlength: 8
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password" // Ensures the value matches the new password
                    }
                },
                messages: {
                    current_password: {
                        required: "Please enter your current password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password: {
                        required: "Please enter a new password",
                        minlength: "Your new password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your new password",
                        minlength: "Your new password must be at least 8 characters long",
                        equalTo: "The confirmation password does not match the new password"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection