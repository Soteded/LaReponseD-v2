@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    @if(session()->get('alert'))
        <div class="alert alert-warning">
            {{ session()->get('alert') }}
        </div><br />
    @endif
        <div class="card">
            <div class="card-header">
                <h2 class="float-left">Contactez-nous :</h2>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('sendMail') }}">
                    @csrf

                    <!--##############################-->
                    <!--           QUESTION           -->
                    <div class="form-group">
                        <label for="title">Titre :</label>
                        <input type="text" class="form-control" placeholder="Votre titre ..." name="title" require/>
                    </div>
                    <div>
                        <label for="msg">Message :</label>
                        <textarea type="text" class="form-control" name="msg" rows="5" cols="33" placeholder="Votre message ..." require></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary float-right" style="margin:10px;">Envoyer !</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection