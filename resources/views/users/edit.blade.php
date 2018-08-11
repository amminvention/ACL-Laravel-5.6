@extends('layouts.app')





@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-dark">
                    <div class="card-header text-white bg-primary">Edit Profile</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        {!! Form::model($user, ['method'=>'PATCH', 'action' => ['UsersController@update', $user->id]]) !!}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
                                </div>
                                <div class="form-group col-md-6">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder'=>'Password']); !!}
                            </div>
                            @if(Auth::user()->role_id == 1)
                                <div class="form-group">
                                    {!! Form::label('role_id', 'Role') !!}
                                    {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
                                </div>
                            @endif
                            <div class="form-group">
                                {!! Form::label('status', 'Status') !!}
                                {!! Form::select('status', array('1'=>'Active', '0'=>'Pending'), null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Update', ['class'=>'btn btn-primary float-right']) !!}
                            </div>
                        {!! Form::close() !!}

                    </div>


                </div>
            </div>
        </div>
    </div>

@stop



