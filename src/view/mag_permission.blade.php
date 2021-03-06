@extends('layouts.app')

@section('content')

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/') }}" >home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link "  href="{{ URL::to('mag_roles') }}" >roles </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active"  href="{{ URL::to('mag_permissions') }}" >permissions </a>
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
            <label class="mr-sm-4 ml-5" for="form1">new permission</label>

            <form action="{{ route('mag_permissions.store') }}" id="form1" method="POST">
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


        <div class="row mt-4 ml-4" >

                <p>to add permission auto : <a class="btn btn-info" href="auto_insert_permission">
                    auto add permission
                </a></p>

            </div>
        <hr>
        <div class="row pr-5 pl-5">
        <table  class="table">
            <thead>
                <tr>
                    <th scope="col">permissions</th>
                    <th scope="col">delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Magpermissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <form action="{{ url('mag_permissions/'.$permission->id ) }}" method="POST">
                                    @csrf
                                    <input class="btn btn-danger" type="submit" value="Delete" />
                                    <input type="hidden" name="_method" value="delete" />
                            </form>
                        </td>
                    </tr>
                @empty
                    empty !! please add new permissins or click auto add permission
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

@endsection



