@extends('layouts.base')

@section('content')
    @include('layouts.tip')
    <link type="text/css" href="https://cdn.bootcss.com/datatables/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">列表</h3>
            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 80px;">
                    @ability('superadministrator', 'create-customer_types')
                        <a href="{{route('customertypes.create')}}" class="btn-sm btn-info">新增</a>
                    @endability
                </div>
            </div>
        </div>
        <div class="box-body">
            <form action="" method="post" class="customertypes-form">
                {{method_field('DELETE')}}
                {{csrf_field()}}
            <table id="customertypes-list-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>CustomerType</th>
                    <th>名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customertypes as $customertype)
                    <tr>
                        <td>{{$customertype->id}}</td>
                        <td>{{$customertype->name}}</td>
                        <td>{{$customertype->display_name}}</td>
                        <td>
                            @ability('superadministrator', 'upade-customer_types')
                                <a href="{{route('customertypes.edit',$customertype->id)}}"  alt="编辑" title="编辑"><i class="fa fa-edit"></i></a>
                            @endability
                            @ability('superadministrator', 'delete-customer_types')
                                <a href="javascript:void(0);" data-id="{{$customertype->id}}"  alt="删除" title="删除" class="delete-operation"><i class="fa fa-trash"></i></a>
                            @endability
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="https://cdn.bootcss.com/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="http://yygh.oss-cn-shenzhen.aliyuncs.com/layer/layer.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#customertypes-list-table').DataTable({
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
                        $('form.customertypes-form').attr('action',"{{route('customertypes.index')}}/"+id);
                        $('form.customertypes-form').submit();
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
