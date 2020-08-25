<?php $user = \Illuminate\Support\Facades\Session::get('user'); ?>
@extends('app')

@section('css')
    <link href="{{ url("/plugins/chart.js/dist/Chart.min.css") }}" rel="stylesheet">

@endsection

@section('body')
    <h2 class="text-success title-header">Welcome<small class="text-muted">, {{ strtoupper($user->level) }}</small></h2>

    <div class="col-md-12">
        <div class="row">

        </div>
    <!-- /.row -->
    </div>
@endsection

@section('js')

@endsection
