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
        <div class="alert">
            {{ session()->get('alert') }}
        </div><br />
    @endif
    </div>
    <div id="racine" class="mainFlex">
        <div class="card" style='margin:1%;width:100%;'>
            <div class="card-header">
                <h2 class="float-left">Users</h2>
                <form action="{{ route('user.index') }}" method="GET">
                    {{ method_field('GET') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary float-right" style="margin-right:10px;"><i class="fas fa-eye"></i></button>
                </form>
            </div>
            <div id="usersDb" class="card-body">
                <table class="table table-striped" style="display:table;">
                    <thead>
                        <tr>
                            <td style="width:5%;"></td>
                            <td style="width:5%;">ID</td>
                            <td style="width:20%;">Nom de compte</td>
                            <td style="width:20%;">Pseudonyme</td>
                            <td style="width:25%;">Email</td>
                            <td style="width:25%;">Créé le :</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $color = true;?>
                        @foreach( $users as $user )
                            <?php
                            if ($color) {
                                echo "<tr style='background-color:#eee;'>";
                            } else {
                                echo "<tr style='background-color:#fff;'>";
                            }?>
                                <td style="width:5%;"><a id='<?php echo $user->id; ?>' class="btn userDetail"><i class="fas fa-plus"></i></a></td>
                                <td style="width:5%; text-align:center;">{{ $user->id }}</td>
                                <td style="width:20%;">
                                    <?php
                                    if ( $user->name == "") { 
                                        echo "<p style='font-style: italic;'>Invalidated</p>";
                                    } else {
                                        echo $user->name;
                                    }
                                    ?>
                                </td>
                                <td style="width:20px;">{{ $user->profile->pseudo }}</td>
                                <td style="width:25%;">{{ $user->email }}</td>
                                <td style="width:25%;">{{ $user->created_at }}</td>
                            </tr>
                            
                            <?php
                            if ($color) {
                                echo "<tr id='infos$user->id' colspan='4' style='background-color:#eee; height:70px; display: none;'>";
                                $color = !$color;
                            } else {
                                echo "<tr id='infos$user->id' colspan='4' style='background-color:#fff; height:70px; display: none;'>";
                                $color = !$color;
                            }?>
                                <td>Rôle actuel : <h6 style="margin:5px;">
                                <?php
                                try {
                                    echo $user->roles->first()['name'];
                                } catch (\Throwable $th) {
                                    echo "Pas de Rôle";
                                }
                                
                                ?>
                                </h6></td>
                                <td>
                                    Quiz(s) créé(s) :
                                    <?php
                                    try {
                                        $count = DB::table('quiz')->select(DB::raw('count(*) as count'))->groupBy('CreatorId')->where('CreatorId','LIKE',$user->id)->get();
                                        $count = json_decode(json_encode($count), true);
                                        echo "<h6>".$count[0]['count']."</h6>";
                                    } catch (\Throwable $th) {
                                        echo '<h6>Aucun</h6>';
                                    }
                                    
                                    ?>

                                </td>
                                <td>
                                    <form action="{{ route('invalidUsername', $user->id) }}" method="PATCH">
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-warning btn-block" onclick="return confirm('Êtes-vous sûr(e) ?')"><i class="fas fa-edit"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Êtes-vous sûr(e) ?')"><i class='fas fa-trash'></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card" style='margin:1%;width:36%;'>
            <div class="card-header">
                <h2 class="float-left">Categories</h2>
                <form action="{{ route('category.create') }}">
                    {{ method_field('GET') }}
                    {{ csrf_field() }}
                    <button type="submit" id="addCateg" class="btn btn-secondary float-right"><i class="fas fa-plus"></i></button>
                </form>
                <form action="{{ route('category.index') }}" method="GET">
                    {{ method_field('GET') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary float-right" style="margin-right:10px;"><i class="fas fa-eye"></i></button>
                </form>
            </div>
            <div id="categDb" class="card-body">
                <table class="table table-striped" style="display:table;">
                    <thead>
                        <tr>
                            <td style="width:20%;">ID</td>
                            <td style="width:45%;">Name</td>
                            <td style="width:15%;"></td>
                            <td style="width:17%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $categories as $category )
                            <tr>
                                <td style="width:20%; text-align:center;">{{ $category->categoryId }}</td>
                                <td style="width:45%;">{{ $category->categoryName }}</td>
                                <td style="width:15%;">
                                    <form action="{{ route('category.edit', $category->categoryId) }}" method="PATCH">
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                    </form>
                                </td>
                                <td style="width:17%;">
                                    <form action="{{ route('category.destroy', $category->categoryId) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr(e) ?')"><i class='fas fa-trash'></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card" style="margin:1%; width: 60%;">
            <div class="card-header">
                <h2 class="float-left">Quizs</h2>
                <form action="{{ route('quiz.index') }}" method="GET">
                    {{ method_field('GET') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary float-right" style="margin-right:10px;"><i class="fas fa-eye"></i></button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped" style="display:table;">
                    <thead>
                        <tr>
                            <td style="width:5%;"></td>
                            <td style="width:15%;">ID</td>
                            <td style="width:15;">Createur</td>
                            <td style="width:25%;">Titre</td>
                            <td style="width:25%;">Catégorie</td>
                            <td style="width:15%;">Questions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $color = true;?>
                        @foreach( $quizs as $quiz )
                            <?php
                            if ($color) {
                                echo "<tr style='background-color:#eee;'>";
                            } else {
                                echo "<tr style='background-color:#fff;'>";
                            }?>
                                <td style="width:5%;"><a id='a<?php echo $quiz->quizId; ?>' class="btn quizDetail"><i class="fas fa-plus"></i></a></td>
                                <td style="width:15%; text-align:center;">{{ $quiz->quizId }}</td>
                                <td style="width:15;">{{ $quiz->user->profile->pseudo }}</td>
                                <td style="width:25%;">{{ $quiz->titre }}</td>
                                <td style="width:25%;">{{ $quiz->category->categoryName }}</td>
                                <td style="width:15%;">{{ count($quiz->questions) }}</td>
                            </tr>

                            <?php
                            if ($color) {
                                echo "<tr id='infosQa$quiz->quizId' colspan='4' style='background-color:#eee; height:auto; display: none;'>";
                                $color = !$color;
                            } else {
                                echo "<tr id='infosQa$quiz->quizId' colspan='4' style='background-color:#fff; height:auto; display: none;'>";
                                $color = !$color;
                            }?>
                                <td>
                                    <form action="{{ route('quiz.destroy', $quiz->quizId ) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger" style="font-size: 10px; margin-right: 2px;" onclick="return confirm('Êtes-vous sûr(e) ?')"><i class='fas fa-trash'></i></button>
                                    </form>
                                </td>

                                <td>
                                    Questions :<br/>
                                    @foreach ($quiz->questions as $question)
                                        "{{ $question->question }}"<br/>
                                    @endforeach
                                </td>

                                <td>
                                    Commentaires : <br/>
                                    @foreach ($quiz->comments as $comment)
                                        <div style="display: flex; padding: 2px;">
                                            <form action="{{ route('userNote.destroy', $comment->userNoteQuizId ) }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger" style="font-size: 10px; margin-right: 2px;" onclick="return confirm('Êtes-vous sûr(e) ?')"><i class='fas fa-trash'></i></button>
                                            </form>
                                            {{ $comment->user->profile->pseudo }} : <b>{{ $comment->titre }}</b> "{{ $comment->corps }}"
                                            <br/>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection