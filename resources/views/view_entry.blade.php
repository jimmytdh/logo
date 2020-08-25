@extends('app')

@section('css')

@endsection

@section('body')
    <h2 class="text-success title-header">Logo <small class="text-muted">Entries</small></h2>
    @if(session('status')=='save')
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Successfully submitted!</h5>
        </div>
    @endif
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select Entry</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="list-group">
                           @foreach($data as $row)
                            <a href="{{ url("/entry/view/".$row->id) }}" class="list-group-item list-group-item-action">
                                Entry No. {{ $row->entry_no }}
                                @if(\App\Http\Controllers\EntryCtrl::submitChecker($row->id))
                                <span class="badge badge-success badge-pill pull-right">
                                    <i class="fa fa-check"></i> Done
                                </span>
                                @endif
                            </a>
                           @endforeach
                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>
            @if($entry!=0)
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ENTRY NO. {{ $info->entry_no }}</h3>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{ url("/entry/vote/".$info->id) }}" method="post">
                                {{ csrf_field() }}
                                    <fieldset>
                                        <legend>Criteria</legend>
                                        <div class="form-group">
                                            <label>Concept (20%)</label>
                                            <input type="number" min="1" max="20" value="{{ \App\Http\Controllers\EntryCtrl::getValue($info->id,'concept') }}" class="form-control" name="concept" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Relevance (20%)</label>
                                            <input type="number" min="1" max="20" value="{{ \App\Http\Controllers\EntryCtrl::getValue($info->id,'relevance') }}" class="form-control" name="relevance" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Originality (20%)</label>
                                            <input type="number" min="1" max="20" value="{{ \App\Http\Controllers\EntryCtrl::getValue($info->id,'originality') }}" class="form-control" name="originality" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Creativity (20%)</label>
                                            <input type="number" min="1" max="20" value="{{ \App\Http\Controllers\EntryCtrl::getValue($info->id,'creativity') }}" class="form-control" name="creativity" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Impact (20%)</label>
                                            <input type="number" min="1" max="20" value="{{ \App\Http\Controllers\EntryCtrl::getValue($info->id,'impact') }}" class="form-control" name="impact" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <img src="{{ url("/logo/".$info->path) }}" width="100%" alt="" class="img-thumbnail">

                                <div class="alert alert-success text-center mt-3">
                                    <h3>{{ \App\Http\Controllers\EntryCtrl::getValue($info->id,'total') }}%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            @else
            <div class="col-sm-8">
                <div class="alert alert-info">
                    Please select entry first!
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection

@section('js')

@endsection
