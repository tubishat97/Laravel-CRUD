@extends('layouts.layout')

@section('content')

    @if ( Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    @if (Session::get('warning'))
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('warning') }}</strong>
        </div>
    @endif

    <div class="table-wrapper data-table">

        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Todo <b>Task</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="javascript:;" class="btn btn-success" onclick="addNewTaskForm();return false; "><i class="material-icons">&#xE147;</i> <span>Add New Task</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
            <tr>
                <td></td>
                <td>{{$task->name}}</td>
                <td>{{$task->description}}</td>
                <td>
                    <a href="javascript:;" class="edit" onclick="editTaskForm('{{$task->id}}');return false; "><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a  href="javascript:;" class="delete" onclick="deleteTaskModal('{{$task->id}}');return false; "><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            {!! $tasks->links() !!}
            <div class="hint-text">Showing <b>{{($tasks->currentpage()-1)*$tasks->perpage()+1}}</b> to <b>{{$tasks->currentpage()*$tasks->perpage()}}</b> of <b>{{$tasks->total()}}</b> entries </div>
        </div>
    </div>

    <div id="todoModal">

    </div>

@endsection

@section('js')

<script>

    function addNewTaskForm(){
        var url = '{{ route("add-task-form") }}';
        $.ajax({
            type: 'get',
            url: url,
            success: function(html) {
                    $('div#todoModal').html(html);
                    $('#addTaskModal').modal();
            }
               });
    }


    function deleteTaskModal(task) {
        var url = '{{ route("delete-modal",":id") }}';
        url = url.replace(':id', task);
        $.ajax({
            type: 'get',
            url: url,
            success: function (html) {
                $('div#todoModal').html(html);
                $('#deleteTaskModal').modal();
            }
        });
    }

    function editTaskForm(task) {
        var url = '{{ route("edit-task-form",":id") }}';
        url = url.replace(':id', task);
        $.ajax({
            type: 'get',
            url: url,
            success: function (html) {
                $('div#todoModal').html(html);
                $('#editTaskModal').modal();
            }
        });
    }
</script>
@endsection


