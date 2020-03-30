@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Score</h2>
                </div>

                <div class="card-body">
                    <h3 class="text-center">Bien joué</h3>
                    <p>Vous avez un score de : <span style="font-weight:bold;">{{ $points }}/{{ $pointsMax }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
