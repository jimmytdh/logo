@extends('app')

@section('css')

@endsection

@section('body')
    <h2 class="text-success title-header">Logo Entries <small class="text-muted">Panel</small></h2>
    @if(session('status')=='save')
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Successfully added!</h5>
        </div>
    @endif

    @if(session('status')=='delete')
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Successfully deleted!</h5>
        </div>
    @endif
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Entry</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{ url('/entry/save') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="entry_no">Entry No.</label>
                                <input type="text" class="form-control" id="entry_no" required name="entry_no" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" required name="name">
                            </div>
                            <div class="form-group">
                                <label>Upload Logo</label>
                                <div class="custom-file">
                                    <input type="file" accept=".png,.jpg,.jpeg" class="custom-file-input" id="logo" name="logo" required>
                                    <label class="custom-file-label" for="customFile">Choose file...</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-block">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-body">
                        @if(count($data)>0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Entry No.</th>
                                        <th>Name</th>
                                        <th>Path</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{ $row->entry_no }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>
                                            <a target="_blank" href="{{ url("/view/logo/".$row->path) }}">View Logo</a>
                                        </td>
                                        <td>
                                            <a href="{{ url("/entry/delete/".$row->id) }}" class="text-danger" onclick="return confirm('Are you sure you want to delete this entry?')">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <img src="{{ url("/images/no_result_found.gif") }}" class="img-thumbnail" alt="">
                        @endif
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
