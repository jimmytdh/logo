<?php $user = \Illuminate\Support\Facades\Session::get('user'); ?>
@extends('app')

@section('css')

@endsection

@section('body')
    <h2 class="text-success title-header">Welcome<small class="text-muted">, {{ strtoupper($user->level) }}</small></h2>
    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $no_entry }}</h3>
                        <p class="text-white">No. of Entries</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bar-chart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $no_judge }}</h3>
                        <p class="text-white">No. of Judges</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @if($user->level=='admin')
        <hr>
        <div class="row">
        @if(count($data)>0)
            @foreach($data as $row)
                <?php $info = \App\Http\Controllers\HomeCtrl::entryInfo($row->entry_id); ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon">
                            <img class="mt-1" src="{{ url("/logo/".$info->path) }}" alt="" width="80px" height="80px" style="vertical-align: top;">
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Entry No. {{ $info->entry_no }}</span>
                            <span class="info-box-number">{{ number_format($row->total,1) }}%</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $row->total }}%"></div>
                            </div>
                            <span class="progress-description">
                                 Rated by {{ $row->judges }} judge(s)
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            @endforeach
        @endif
        </div>
        @endif
    </section>
@endsection

@section('js')

@endsection
