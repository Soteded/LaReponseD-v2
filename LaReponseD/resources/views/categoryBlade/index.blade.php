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
    <div class="card" style="width: 40vw; margin-left: auto; margin-right: auto;">
        <div class="card-header">
            <h2 class="float-left">Liste des catégories :</h2>
            <form action="{{ route('category.create') }}">
                {{ method_field('GET') }}
                {{ csrf_field() }}
                <button type="submit" id="addCateg" class="btn btn-secondary float-right"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div id="usersDb" class="card-body">
            <table class="table table-striped" style="display:table;">
                <thead>
                    <tr>
                        <td style="width:5%;"></td>
                        <td style="width:10%;">ID</td>
                        <td style="width:30%;">Name</td>
                    </tr>
                </thead>
                <tbody style="height:500px;">
                    <?php $color = true;?>
                    @foreach( $categories as $category )
                        <?php
                        if ($color) {
                            echo "<tr style='background-color:#eee;'>";
                        } else {
                            echo "<tr style='background-color:#fff;'>";
                        }?>
                            <td style="width:5%;"><a id='<?php echo $category->categoryId; ?>' class="btn userDetail" href="#"><i class="fas fa-plus"></i></a></td>
                            <td style="width:10%; text-align:center;">{{ $category->categoryId }}</td>
                            <td style="width:30%;">{{ $category->categoryName }}</td>
                        </tr>
                        
                        <?php
                        if ($color) {
                            echo "<tr id='infos$category->categoryId' colspan='3' style='background-color:#eee; height:70px; display: none;'>";
                            $color = !$color;
                        } else {
                            echo "<tr id='infos$category->categoryId' colspan='3' style='background-color:#fff; height:70px; display: none;'>";
                            $color = !$color;
                        }?>
                        <td>Nombre de quizs :
                            <?php
                            try {
                                $count = DB::table('quiz')->select(DB::raw('count(*) as count'))->groupBy('RCategoryId')->where('RCategoryId','LIKE',$category->categoryId)->get();
                                $count = json_decode(json_encode($count), true);
                                echo "<h6>".$count[0]['count']."</h6>";
                            } catch (\Throwable $th) {
                                echo '<h6>Aucun</h6>';
                            }
                            
                            ?>
                        </td>
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
</div>
@endsection