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
    </div>
    <div class="card" style="width: 50vw; margin-left: auto; margin-right: auto;">
        <div class="card-header">
            <h2 class="float-left">Changer le role de {{ $user->name }} :</h2>
        </div>
        <div id="usersDb" class="card-body">
            <h5 style="margin:20px;"> Rôle actuel : <span style="font-weight:bold;">{{ $user->roles->first()['name'] }}</span></h5>

            <h3 style="text-align:center;">Changer le rôle pour :</h3>
            <div class="mainFlex" style="justify-content: center;">
                @if ( $user->roles->first()['name'] == 'Admin' )
                    <?php
                    $roleName1 = 'Modo';
                    $roleName2 = 'User';
                    ?>
                    <form action="{{ route('updateRole', [$user->id, $roleName1]) }}" method="PATCH">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100px; margin:10px;">Modo</button>
                    </form>
                    <form action="{{ route('updateRole', [$user->id, $roleName2]) }}" method="PATCH">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100px; margin:10px;">User</button>
                    </form>
                @elseif ( $user->roles->first()['name'] == 'Modo' )
                    <?php
                    $roleName1 = 'Admin';
                    $roleName2 = 'User';
                    ?>
                    <form action="{{ route('updateRole', [$user->id, $roleName1]) }}" method="PATCH">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100px; margin:10px;">Admin</button>
                    </form>
                    <form action="{{ route('updateRole', [$user->id, $roleName2]) }}" method="PATCH">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100px; margin:10px;">User</button>
                    </form>
                @else
                    <?php
                    $roleName1 = 'Admin';
                    $roleName2 = 'Modo';
                    ?>
                    <form action="{{ route('updateRole', [$user->id, $roleName1]) }}" method="PATCH">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100px; margin:10px;">Admin</button>
                    </form>
                    <form action="{{ route('updateRole', [$user->id, $roleName2]) }}" method="PATCH">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100px; margin:10px;">Modo</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection