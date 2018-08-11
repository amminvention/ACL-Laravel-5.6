@extends('layouts.app')





@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-dark">
                    <div class="card-header text-white bg-primary">All Users</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <a class="btn btn-primary mb-3" href="{{ route('users.create') }}" role="button">Add user</a>


                        <table class="table">
                            <thead>
                                <tr style="font-weight: bold">
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Role</td>
                                    @if(Auth::user()->role_id < 3)
                                        <td>Action</td>
                                        <td>Status</td>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="font-weight: bold"><a href="{{route('users.show', ['id'=>$user->id])}}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        @if(Auth::user()->role_id < 3)
                                            <a href="{{ route('users.edit', ['id'=>$user->id]) }}">Edit</a>
                                            @if(Auth::user()->role_id === 1)
                                                |
                                                <a href="{{ route('users.destroy', ['id'=>$user->id]) }}"
                                                   onclick="event.preventDefault();
                                                document.getElementById('delete-form').submit();" >Delete</a>

                                                {!! Form::open(['method'=>'DELETE', 'action' => ['UsersController@destroy', $user->id], 'id'=>'delete-form']) !!}

                                                {!! Form::close() !!}

                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $user->status == 1 ? 'Active' : 'Pending' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                            <div class="float-right">
                                {{ $users->links() }}
                            </div>


                    </div>


                </div>
            </div>
        </div>
    </div>

@stop



