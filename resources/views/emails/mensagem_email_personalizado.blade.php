@extends('layouts.email')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-2">

            </div>
            <div class="col-md-auto"  style="padding-top:10px;">
                <div class="card">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <img src="https://i.ibb.co/pJHkzZw/logo.png" alt="logo" border="0" width="120" height="120" />
                                </div>
                                <div class="col-4">
                                    <p>{{$text}}</p>

                                </div>
                            </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body">
                                    <table>
                                    <p>Para acessar o site <a href="colinasjobs.site">Clique aqui</a></p>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-2">

            </div>
        </div>
    </div>
        {{-- Parabéns a, a empresa a gostou do seu currículo. --}}
        {{-- <img src="logo\logo.png" width="128" height="128"> --}}
@endsection
