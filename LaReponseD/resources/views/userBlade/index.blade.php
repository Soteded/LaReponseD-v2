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
    @if(session()->get('error'))
        <div class="alert alert-error">
            {{ session()->get('error') }}
        </div><br />
    @endif
    </div>
    <div class="card" style="width: 50vw; margin-left: auto; margin-right: auto;">
        <div class="card-header">
            <h2 class="float-left">Liste des Utilisateurs :</h2>
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
                <tbody style="height: 50vh;">
                    <?php $color = true;?>
                    @foreach( $users as $user )
                        <?php
                        if ($color) {
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
                        if ($color) {
                            echo "<tr id='infos$user->id' colspan='4' style='background-color:#eee; height:80px; display: none;'>";
                            $color = !$color;
                        } else {
                            echo "<tr id='infos$user->id' colspan='4' style='background-color:#fff; height:80px; display: none;'>";
                            $color = !$color;
                        }
                        $userProfile = DB::table('profile')->select(DB::raw('*'))->where('userId','LIKE',$user->id)->get();
                        $userProfile = json_decode(json_encode($userProfile), true);
                        ?>
                            <td>
                                <img src="/uploads/avatars/<?php echo $userProfile[0]['avatar'];?>" style="width:50px; height:50px; top:10px; left:10px;">
                            </td>
                            <td>Rôle actuel : <h6 style="margin:5px;">
                                <?php
                                try {
                                    echo $user->roles->first()['name'];
                                } catch (\Throwable $th) {
                                    echo "Pas de Rôle";
                                } ?></h6>
                            </td>
                            <td>
                                <form action="{{ route('editRole', $user->id) }}" method="GET">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary btn-block">Changer le role</button>
                                </form>
                            </td>
                            <td>
                                Quiz(s) créé(s) :
                                <?php
                                try {
                                    $count = DB::table('quiz')->select(DB::raw('count(*) as count'))->groupBy('CreatorId')->where('CreatorId','LIKE',$user->id)->get();
                                    $count = json_decode(json_encode($count), true);
                                    echo "<h6>".$count[0]['count']."</h6>";
                                } catch (\Throwable $th) {
                                    echo '<h6>Aucun</h6>';
                                } ?>
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
</div>
@endsection
