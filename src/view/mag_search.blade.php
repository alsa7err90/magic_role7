@extends('layouts.app')
@section('content')
    <style>
        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        .menu li {
            float: left;
            display: inline;
        }

        .menu li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .menu li a:hover:not(.active) {
            background-color: #111;
        }

        .menu .active {
            background-color: rgb(77, 48, 241);
        }

        @media screen and (min-width: 480px) {
            input[type=text] {
                width: 30%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;
                border: 2px solid rgb(77, 48, 241);
                border-radius: 4px;
            }
        }

        @media screen and (max-width: 480px) {
            input[type=text] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;
                border: 2px solid rgb(77, 48, 241);
                border-radius: 4px;
            }
        }

        .button {
            background-color: rgb(77, 48, 241);
            /* Green */
            border: 1px solid rgb(77, 48, 241);
            color: white;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .container1{
            background-color: rgb(255, 255, 255);

            box-shadow: 5px 5px 8px 5px #807474;
            border-radius: 10px;
            margin: auto;
            width: 98%;
        }

        .content {
            padding: 10px;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: rgb(25, 27, 29);
            color: white;
        }

        .danger {
            background-color: rgb(255, 30, 30);
            color: #fff;
            padding: 10px;
            font-size: 14px;

        }
        .info {
            background-color: rgb(77, 48, 241);
            color: #fff;
            padding: 10px;
            font-size: 16px;
            text-decoration: none;

        }
        .info:hover{
            color: #fff;
            text-decoration: none;
        }
    </style>

    <div class="container1">
        <ul  class="menu">
            <li>
                <a href="{{ URL::to('/') }}">home </a>
            </li>
            <li>
                <a  href="{{ URL::to('mag_roles') }}">roles </a>
            </li>
            <li >
                <a  href="{{ URL::to('mag_permissions') }}">permissions </a>
            </li>
            <li class="active">
                <a href="{{ URL::to('mag_users') }}">users </a>
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

        <div class="content">
            <form action="{{ url('search_user') }}"  method="POST">
                <input type="text" name="text" placeholder="Search">
                <button class="button" type="submit">
                    search
                </button>
                @csrf
            </form>

            <table  id="customers">
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
@endsection
