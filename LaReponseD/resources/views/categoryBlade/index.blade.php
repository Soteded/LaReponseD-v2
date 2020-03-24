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
    <div class="card" style="display: block; margin-left: auto; margin-right: auto;">
        <div class="card-header">
            <h2 class="center">Liste des catégories :</h2>
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
                <tbody>
                    @foreach( $categories as $category )
                        <?php
                        if ($category->categoryId%2 == 1) {
                            echo "<tr style='background-color:#eee;'>";
                        } else {
                            echo "<tr style='background-color:#fff;'>";
                        }?>
                            <td style="width:5%;"><a id='<?php echo $category->categoryId; ?>' class="btn userDetail" href="#"><i class="fas fa-plus"></i></a></td>
                            <td style="width:10%; text-align:center;">{{ $category->categoryId }}</td>
                            <td style="width:30%;">{{ $category->categoryName }}</td>
                        </tr>
                        
                        <?php
                        if ($category->categoryId%2 == 1) {
                            echo "<tr id='infos$category->categoryId' colspan='3' style='background-color:#eee; height:70px; display: none;'>";
                        } else {
                            echo "<tr id='infos$category->categoryId' colspan='3' style='background-color:#fff; height:70px; display: none;'>";
                        }?>
                            <td>long long text</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection