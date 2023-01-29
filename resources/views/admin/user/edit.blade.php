@extends('admin.layout.master')

@section('title')
    User Edit
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Edit</small>
                    </h1>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action={{ route('admin.user.update', $user->id) }} method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>User Name</label>
                                <input class="form-control" name="name" value="{{ $user->name }}"
                                    placeholder="Please Enter User Name" />
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" value="{{ $user->email }}"
                                    placeholder="Please Enter Email" disabled />
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Please Enter Password" />
                                @error('password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="Please Enter Confirm Password" />
                                @error('confirm_password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Is Admin?</label><br>
                                <label class="radio-inline">
                                    <input name="is_admin" value="0" @if (!$user->is_admin) checked @endif
                                        checked type="radio">User
                                </label>
                                <label class="radio-inline">
                                    <input name="is_admin" value="1" @if ($user->is_admin) checked @endif
                                        type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Create</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    @endsection
