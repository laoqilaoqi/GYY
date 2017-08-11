<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Cate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //分类列表页

//        $cates = Cate::("concat(type_path,',',type_pid)") ->get()
//       $cates = Cate::select(Cate::raw("*,concat(type_path,',',type_pid) as paths"))->
//       orderBy('paths')->get();

        $res = DB::table('type')->
        select(DB::raw("*,concat(type_path,',',type_id) as paths"))->
        orderBy('paths')->where('type_name','like','%'.$request->input('search').'%')->
        paginate($request->input('num',3));

        foreach($res as $k => $v){

            //拆分path
            $data = explode(',',$v->type_path);

            $count = count($data)-1;

            $v->type_name = str_repeat('|--', $count).$v->type_name;
        }


//            dd($res);
        return view('admin.cate.index',compact('res','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加分类
        $res = DB::table('type')->
        select(DB::raw("*,concat(type_path,',',type_id) as paths"))->
        orderBy('paths')->
        get();

        //通过path判断
        foreach($res as $k => $v){

            //拆分path
            $data = explode(',',$v->type_path);

            $count = count($data)-1;

            $v->type_name = str_repeat('|--', $count).$v->type_name;
        }

        return view('admin.cate.add',compact('res'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $res =  $request->except('_token');
//        dd($res);
        if ($res['type_pid'] == '0') {

            //凭借path
            $res['type_path'] = '0';
        } else {

            $info = Cate::where('type_id', $res['type_pid'])->first();

//            dd($info);
            $res['type_path'] = $info->type_path.','.$info->type_id;
        }


        $re  = Cate::create($res);
        if($re){
            return redirect('admin/cate');
        }else{
            return back()->with('msg','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cates =  Cate::find($id);
//        dd($cate);
        $res = DB::table('type')->
        select(DB::raw("*,concat(type_path,',',type_id) as paths"))->
        orderBy('paths')->
        get();

        //通过path判断
        foreach($res as $k => $v){

            //拆分path
            $data = explode(',',$v->type_path);

            $count = count($data)-1;

            $v->type_name = str_repeat('|--', $count).$v->type_name;
        }
        return view('admin.cate.edit',compact('res','cates'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

//        dd($request->all());

        $res =  $request->except('_token');
//        dd($res);
        if ($res['type_pid'] == '0') {

            //凭借path
            $res['type_path'] = '0';
        } else {

            $info = Cate::where('type_id', $res['type_pid'])->first();

//            dd($info);
            $res['type_path'] = $info->type_path.','.$info->type_id;
        }

        $cate = Cate::find($id);
        $re =  $cate->update($res);

        if($re){
            return redirect('admin/cate');
        }else{
            return back()->with('msg','修改失败');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cates = Cate::find($id);

//        是否有二级类
        $count =  Cate::where('type_pid',$id)->count();

//        dd($cate);
        if($cates->type_pid == 0 && $count){

            $data = [
                'status'=>2,
                'msg'=>'一级分类不允许删除'
            ];
            return $data;
        }
        $re = $cates->delete();
        //        返回修改状态
        if($re){
            $data = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }

}
