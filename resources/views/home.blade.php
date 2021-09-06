@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->imaUlogu('doktor'))
                            <p>
                                Postovani Doktore {{ Auth::user()->name }}, ovo je pocetni ekran, odavde mozete da idete na
                                neke od ponudjenih opcija:
                            </p>
                            @else
                            <p>
                                Postovani/a {{ Auth::user()->name }}, ovo je pocetni ekran, odavde mozete da idete na
                                neke od ponudjenih opcija:
                            </p>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
