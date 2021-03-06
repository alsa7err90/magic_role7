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

        <div class="container">
            <div class="row">
                <div class="col-sm">
                    the role have :<br>
                    <form action="{{ url('unckeck_permission_from_role') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_role"  value="{{  $id }}">
                        @forelse($mag_permissions as $permission)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="unckeck[]" class="custom-control-input" value="{{  $permission->id }}" id="{{  $permission->id }}">
                            <label class="custom-control-label" for="{{  $permission->id }}">{{  $permission->name }}</label>
                          </div>
                        @empty
                            is impty !! this role don't have any permission
                        @endforelse
                        <input type="submit"  class="btn btn-danger" value="remove">
                    </form>
                    @php
                     // $results=array_diff($all_permissions,$mag_permissions);
                     @endphp
                </div>
                <div class="col-sm">
                    <br>
                    don't have :<br>
                    <form action="{{ url('ckeck_permission_from_role') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_role"  value="{{  $id }}">
                        @forelse($all_permissions as $all_permission)
                            @unless(in_array($all_permission->name,$mag_permissions_array))
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="ckeck[]" class="custom-control-input" value="{{  $all_permission->id }}" id="{{  $all_permission->id }}">
                                <label class="custom-control-label" for="{{  $all_permission->id }}">{{  $all_permission->name }}</label>
                              </div>

                            @endunless
                        @empty
                            is impty !! go to  <a href="{{ URL::to('mag_permissions') }}" >permissions </a>
                            to add new permission

                        @endforelse
                        <input type="submit"  class="btn btn-primary" value="add">
                    </form>
                </div>
            </div>
        </div>


    @endsection
