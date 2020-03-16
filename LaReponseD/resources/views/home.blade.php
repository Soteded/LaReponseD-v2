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
        @if(session()->get('alert'))
            <div class="alert alert-warning">
                {{ session()->get('alert') }}
            </div><br />
        @endif
            <div class="card">
                <div class="card-header">
                    <h2 class="float-left">Dashboard</h2>
                    <button type="button" class="btn btn-primary float-right" onclick="window.location='{{ url('quiz/create') }}'">Créer un quiz</button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Hey, re ! :)</p>

                    <h5>Tes quizs ont été joués :</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Quizz :</td>
                                <td>Joués (X) fois :</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    $quizs = DB::table('quiz')->where('user_id','LIKE',Auth::user()->id)->get();
                                    $quizs = json_decode(json_encode($quizs), true);
                                    foreach ($quizs as $quiz) {?>
                                        <td class="text-center">{{ $quiz["titre"] }}</td>
                                        <td class="text-center">{{ $quiz["joues"] }}</td>
                                    <?php
                                }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection