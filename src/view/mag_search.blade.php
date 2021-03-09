@extends('layouts.app')
@section('content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/') }}">home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ URL::to('mag_roles') }}">roles </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('mag_permissions') }}">permissions </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ URL::to('mag_users') }}">users </a>
            </li>
        </ul>

        <div id="app">
            <form action="{{ url('search_user') }}" class="form-inline" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="text" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>

                @csrf
            </form>

            <div class="row mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">NAME</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ROLE</th>
                            <th scope="col">SELECT</th>
                            <th scope="col">EDIT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($magUsers as $magUser)
                            <tr>
                                <td>
                                    {{ $magUser->id }}
                                </td>
                                <td>
                                    {{ $magUser->name }}
                                </td>
                                <td>
                                    {{ $magUser->email }}
                                </td>
                                <td>{{ $magUser->roles[0]->name ?? "don't have role" }}
                                </td>
                                <form action="{{ url('edit_role_user/'.$magUser->id) }}" method="POST">
                                    <td>
                                        <select class="form-control" name="new_role" id="{{ $magUser->id }}">
                                            <option> select role </option>
                                            @foreach ($magRoles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @csrf
                                    <td><input type="submit" value="save"></td>
                                </form>
                            </tr>
                        @empty
                            don't found data!!
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
