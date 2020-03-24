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
        <div class="card" style='margin:1%;width:62%;'>
            <div class="card-header">
                <h2 class="center">Users</h2>
            </div>
            <div id="usersDb" class="card-body">
                <table class="table table-striped" style="display:table;">
                    <thead>
                        <tr>
                            <td style="width:5%;"></td>
                            <td style="width:10%;">ID</td>
                            <td style="width:30%;">Name</td>
                            <td style="width:45%;">Email</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $user )
                            <?php
                            if ($user->id%2 == 1) {
                                echo "<tr style='background-color:#eee;'>";
                            } else {
                                echo "<tr style='background-color:#fff;'>";
                            }?>
                                <td style="width:5%;"><a id='<?php echo $user->id; ?>' class="btn userDetail" href="#"><i class="fas fa-plus"></i></a></td>
                                <td style="width:10%; text-align:center;">{{ $user->id }}</td>
                                <td style="width:30%;">
                                    <?php
                                    if ( $user->name == "") { 
                                        echo "<p style='font-style: italic;'>Invalidated</p>";
                                    } else {
                                        echo $user->name;
                                    }
                                    ?>
                                </td>
                                <td style="width:45%;">{{ $user->email }}</td>
                            </tr>
                            
                            <?php
                            if ($user->id%2 == 1) {
                                echo "<tr id='infos$user->id' colspan='4' style='background-color:#eee; height:70px; display: none;'>";
                            } else {
                                echo "<tr id='infos$user->id' colspan='4' style='background-color:#fff; height:70px; display: none;'>";
                            }?>
                                <td>Rôle actuel : <h6 style="margin:5px;">
                                <?php
                                try {
                                    echo $user->roles->first()['name'];
                                } catch (\Throwable $th) {
                                    echo "No roles ?";
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
                                <td valign="middle">
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
        <div class="card" style='margin:1%;width:34%;'>
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
        <div class="card" style="margin:1%; width: 70%;">
            <div class="card-header">
                <h2 class="float-left">Profiles</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped" style="display:table;">
                    <thead>
                        <tr>
                            <td style="width:10%;">ID</td>
                            <td style="width:30%;">Pseudo</td>
                            <td style="width:30%;">Date de Naissance</td>
                            <td style="width:30%;">Créé le :</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $profiles as $profile )
                            <tr>
                                <td style="width:10%;">{{ $profile->profileId }}</td>
                                <td style="width:30%;">{{ $profile->pseudo }}</td>
                                <td style="width:30%;">{{ $profile->birthDate }}</td>
                                <td style="width:30%;">{{ $profile->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection