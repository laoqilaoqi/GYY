@extends('layout.admin')

@section('title', '分类的添加页面')

@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>分类添加页面</span>
    </div>
	@if(session('msg'))
		<div class="mark">
			<ul>
				<li>{{ session('msg') }}</li>
			</ul>
		</div>
	@endif

    <div class="mws-panel-body no-padding">
    	<form action={{url('admin/cate')}} method='post' class="mws-form">

    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">父类名:</label>
    				<div class="mws-form-item">
    					<select class="small" name='type_pid'>
    						<option value='0'>请选择</option>
							@foreach($res as $k => $v)

    						<option value='{{$v->type_id}}'>{{$v->type_name}}</option>

    						@endforeach
    					</select>
    				</div>
    			</div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">分类名:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='type_name' value="{{old('name')}}">
    				</div>
    			</div>


    		</div>
    		<div class="mws-button-row">
    			<input type="submit" class="btn btn-danger" value="添加">
    			{{csrf_field()}}
    		</div>
    	</form>
    </div>    	
</div>


@endsection