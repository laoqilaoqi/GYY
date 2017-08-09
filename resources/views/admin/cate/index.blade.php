@extends('layout.admin')

@section('title','商品分类页')

@section('content')

    <div class="mws-panel grid_8" >
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 商品分类</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">
                <form action={{url('admin/cate')}} method='get'>
                <div id="DataTables_Table_1_length" class="dataTables_length">
                    <label>显示
                        <select name="num" size="1" aria-controls="DataTables_Table_1">
                            <option value="5" @if($request->num == '5')selected="selected" @endif>5</option>
                           <option value="10" @if($request->num == '10')selected="selected" @endif>10</option>
                            <option value="15" @if($request->num == '15')selected="selected" @endif>15</option>
                        </select> 条数据
                    </label>
                </div>
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    <label>关键字:
                        <input type="text" name='search' value="{{$request->search}}" aria-controls="DataTables_Table_1">
                        <button class='btn btn-md btn-info'>搜索</button>
                    </label>
                </div>
                </form>
                <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 160px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">分类ID</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 208px;" aria-label="Browser: activate to sort column ascending">类名</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 195px;" aria-label="Platform(s): activate to sort column ascending">type_pid</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 135px;" aria-label="Engine version: activate to sort column ascending">type_path</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 98px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
                    </tr>
                    </thead>

                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                    @foreach($res as $k=>$v)
                    <tr class="@if ($k % 2 == 1) odd @else even @endif">
                        <td class="  sorting_1">{{$v->type_id}}</td>
                        <td class=" ">{{$v->type_name}}</td>
                        <td class=" ">{{$v->type_pid}}</td>
                        <td class=" ">{{$v->type_path}}</td>
                        <td class=" ">
                            <a href="{{url('admin/cate/'.$v->type_id.'/edit')}}" class='btn btn-success'>修改</a>
                            <a href="javascript:void(0)" onclick="delCate({{$v->type_id}})" class='btn btn-warning'>删除</a>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
                <style type="text/css">
                    #page li{

                        background-color: #444444;
                        border-left: 1px solid rgba(255, 255, 255, 0.15);
                        border-right: 1px solid rgba(0, 0, 0, 0.5);
                        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.5), 0 1px 0 rgba(255, 255, 255, 0.15) inset;
                        color: #fff;
                        cursor: pointer;
                        display: block;
                        float: left;
                        font-size: 12px;
                        height: 20px;
                        line-height: 20px;
                        outline: medium none;
                        padding: 0 10px;
                        text-align: center;
                        text-decoration: none;
                    }
                    #page .active{
                        background-color: #88a9eb;
                        background-image: none;
                        border: medium none;
                        box-shadow: 0 0 4px rgba(0, 0, 0, 0.25) inset;
                        color: #323232;
                    }

                    #page a{

                        color: #fff;
                    }

                    #page .disabled{

                        color: #666666;
                        cursor: default;
                    }

                    #page ul{

                        margin:0px;
                    }
                </style>

                <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                    <div id='page'>
                    {!! $res->appends($request->all())->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>



        function delCate(id){
//            参数1 要请求的服务器路由
//            参数2 请求要携带的参数数据  _method：delete  _token
//              参数3 回调函数,回调函数的参数data表示服务器返回的数据
//            $.post(URL,data,callback);
//            alert($);
//询问框
            layer.confirm('确认删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
//            layer.msg('删除成功', {icon: 1});
                $.post("{{url('admin/cate/')}}/"+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
//                console.log(data);
                    if(data.status == 0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else if(data.status == 2){
                        layer.msg(data.msg, {icon: 5});
                    }else{
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 5});
                    }

                });

            }, function(){

            });

        }


    </script>
@endsection

