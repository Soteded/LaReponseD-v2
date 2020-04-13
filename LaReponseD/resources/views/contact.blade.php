@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="card">
            <div class="card-header">
                <h2 class="float-left">Contactez-nous :</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('sendemail/send') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Entrez votre nom :</label>
                        <input type="text" name="name" class="form-control" require/>
                    </div>

                    <div class="form-group">
                        <label for="email">Entrez votre mail :</label>
                        <input type="text" name="email" class="form-control" require/>
                    </div>

                    <div>
                        <label for="msg">Message :</label>
                        <textarea type="text" class="form-control" name="message" rows="5" cols="33" require></textarea>
                    </div>

                    <input type="submit" name="send" value="Send" class="btn btn-info" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection