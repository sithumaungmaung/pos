@extends('layout')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('user.menu')
                <h3 class="panel-title"><i class="fi-page-edit"></i> Edit User</h3>
            </div>

            <div class="panel-body">
                {{ Form::model($user, ['url' => route('users.update'), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::text('email', null, ['class' => 'form-control']) }}

                            @if($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password', ['class' => 'form-control']) }}

                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}

                            @if($errors->has('name'))
                                <p class="help-block">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                            {{ Form::label('role', 'Role') }}
                            {{ Form::select('role', $roles, $user->groups[0] ? $user->groups[0]->id : null, ['class' => 'form-control']) }}

                            @if($errors->has('role'))
                                <p class="help-block">{{ $errors->first('role') }}</p>
                            @endif
                        </div>
                    </div>

                    
                </div>

                <div class="row">
                    
                    
                </div>

                {{-- <div class="row">
                    

                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('activated') ? 'has-error' : '' }}">
                            {{ Form::label('activated', 'Activation Status') }}
                            {{ Form::select('activated', ['' => 'Select Status', 0 => 'Inactive', 1 => 'Active'], null, ['class' => 'form-control']) }}

                            @if($errors->has('activated'))
                                <p class="help-block">{{ $errors->first('activated') }}</p>
                            @endif
                        </div>
                    </div>
                </div> --}}

                <div class="for-group text-right">
                    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
