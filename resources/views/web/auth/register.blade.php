@extends('web.layout.master')

@section('content')
    <section class="section wb mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-wrapper" method="post" action="{{ route('web.auth.register') }}">
                        @csrf
                        <input type="text" name="name" class="form-control" placeholder="Your name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="email" class="form-control" placeholder="Your email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password">
                        @error('confirm_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div><!-- end page-wrapper -->
        </div><!-- end col -->
        </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
