@extends('layouts.app')





@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-dark">
                    <div class="card-header text-white bg-primary">{{ $user->name }}'s Profile</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>{{ $user->role['name'] }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $user->status == 1 ? 'Active' : 'Pending' }}</td>
                            </tr>
                        </table>


                    </div>


                </div>
            </div>
        </div>
    </div>

@stop



