@extends('layout.admin')

@section('title', '后台首页')

@section('content')

    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                {{--<li>--}}
                    {{--<label>操作系统</label><span>{{$_SERVER['WINDIR']}}</span>--}}
                {{--</li>--}}
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
                </li>


                <li>
                    <label>上传附件限制</label><span><?php echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"不允许上传附件"; ?></span>
                </li>
                <li>
                    <label>北京时间</label><span>{{date('Y-m-d H:i:s')}}</span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['SERVER_ADDR']}} [{{$_SERVER['SERVER_NAME']}} ]</span>
                </li>
                <li>
                    <label>Host</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
                </li>
            </ul>
        </div>
    </div>



@endsection