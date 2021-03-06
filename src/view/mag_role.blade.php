@extends('layouts.app')

@section('content')

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/') }}" >home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active"  href="{{ URL::to('mag_roles') }}" >roles </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ URL::to('mag_permissions') }}" >permissions </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('mag_users') }}" >users </a>
            </li>
        </ul>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row mt-4" >
            <label class="mr-sm-2" for="form1">new role</label>
            <form action="{{ route('mag_roles.store') }}" id="form1" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <input  class="form-control" type="text" name="name" placeholder="name">
                    </div>
                    <div class="col">
                        <input  class="form-control" type="text" name="slug" placeholder="slug">
                    </div>

                    <div class="col">
                        <input  type="submit" class="btn btn-primary" value="add">
                    </div>
                </div>
            </form>
        </div>

        <br>Roles : Choose one of the roles to edit <br>
        <table  class="table">
            <thead>
                <tr>
                    <th scope="col">name</th>
                    <th scope="col">edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td> - <a >{{ $role->name }}</a></td>
                        <td><a class="btn btn-default" href="{{ URL::to('mag_roles/' . $role->id) }}">edit permission</a></td>
                        <td>
                            <form action="{{ url('mag_roles/' .  $role->id ) }}" method="POST">
                                @csrf
                                <input  class="btn btn-danger" type="submit"  value="Delete" />
                                <input type="hidden" name="_method" value="delete" />
                            </form>
                        </td>
                    </tr>
                @empty
                    empty !! pleas add new roles
                @endforelse
            </tbody>
        </table>



    @endsection
