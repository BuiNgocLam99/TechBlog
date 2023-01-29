@extends('web.layout.master')

@section('content')
    <section class="section wb mt-5">
        <div class="container">
            <div class="row">
                @if (session('error'))
                    <div class="col-lg-12">
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="col-lg-12">
                        <div class="alert alert-success">{{ session('success') }}</div>
                    </div>
                @endif
                <div class="col-lg-12">
                    <form class="form-wrapper" method="post" action="{{ route('web.auth.login') }}">
                        @csrf
                        <input type="text" name="email" class="form-control" placeholder="Your email">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="{{ route('web.auth.form-register') }}">Register</a>
                    </form>
                </div>
            </div>
        </div><!-- end page-wrapper -->
        </div><!-- end col -->
        </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
