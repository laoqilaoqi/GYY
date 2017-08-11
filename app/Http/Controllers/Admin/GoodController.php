<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Good;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlockFactory;

class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //商品列表
        $res = Good::where('goods_name', 'like', '%'.$request->input('search').'%')->
        paginate($request->input('num',3));
        return view('admin.good.index',compact('res','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加商品

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
        return view('admin.good.add', ['res'=>$res]);


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

        $data = $request->all();
        dd($data);
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
    }
}
