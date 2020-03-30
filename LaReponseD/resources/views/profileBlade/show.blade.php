@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @elseif(session()->get('alert'))
        <div class="alert alert-warning">
            {{ session()->get('alert') }}
        </div><br />
    @elseif (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <div class="card">
            <div class="card-header">
                <h2 class="float-left">Main Menu</h2>
                <button type="button" class="btn btn-primary float-right" onclick="window.location='{{ url('quiz/create') }}'">Créer un quiz</button>
            </div>

            <div class="card-body">
                <p>Hey, re ! :)</p>
            </div>
        </div>
    </div>
</div>
@endsection