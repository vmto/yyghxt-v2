@extends('layouts.base')

@section('content')
    @include('layouts.tip')
    <link type="text/css" href="/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">用户列表</h3>
            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 80px;">
                    @ability('superadministrator', 'create-users')
                        <a href="{{route('users.create')}}" class="btn-sm btn-info">新增用户</a>
                    @endability
                </div>
            </div>
        </div>
        <form action="" method="post" class="users-form">
            {{method_field('DELETE')}}
            {{csrf_field()}}
        <div class="box-body table-responsive">
            <table id="user-list-table" class="table table-striped table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>登录id</th>
                    <th>姓名</th>
                    <th>部门</th>
                    <th>账户状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        {{--<td data-toggle="tooltip" data-placement="top" title="@foreach($user->hospitals as $hospital){{$hospital->display_name}} @endforeach">{{$user->realname}}</td>--}}
                        <td title="@foreach($user->hospitals as $hospital){{$hospital->display_name}} @endforeach">{{$user->realname}}</td>
                        <td>{{$user->department_id?$user->department->display_name:''}}</td>
                        <td>
                            @if($user->is_active==1)
                                <span class="label label-success">正常</span>
                            @else
                                <span class="label label-danger">失效</span>
                            @endif
                        </td>
                        <td>
                            @if($enableUpdate)
                                <a href="{{route('users.edit',$user->id)}}"  alt="编辑" title="编辑"><i class="fa fa-edit"></i></a>
                            @endif
                            @if($enableDelete)
                                <a href="javascript:void(0);" data-id="{{$user->id}}"  alt="删除" title="删除" class="delete-operation" style="margin-left: 10px;"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </form>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/asset/layer/layer.js"></script>
    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip();
        $(document).ready(function() {
            $('#user-list-table').DataTable({
                "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
                "language": {
                    "url": "/datables-language-zh-CN.json"
                }
            });
            $(".delete-operation").on('click',function(){
                var id=$(this).attr('data-id');
                layer.open({
                    content: '你确定要删除吗？',
                    btn: ['确定', '关闭'],
                    yes: function(index, layero){
                        $('form.users-form').attr('action',"{{route('users.index')}}/"+id);
                        $('form.users-form').submit();
                    },
                    btn2: function(index, layero){
                        //按钮【按钮二】的回调
                        //return false 开启该代码可禁止点击该按钮关闭
                    },
                    cancel: function(){
                        //右上角关闭回调
                        //return false; 开启该代码可禁止点击该按钮关闭
                    }
                });
            });
        } );
    </script>
@endsection
