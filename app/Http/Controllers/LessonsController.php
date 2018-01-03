<?php

namespace App\Http\Controllers;

use App\Transformer\LessonTransformer;
use Illuminate\Http\Request;

use App\Lesson;

class LessonsController extends ApiController
{
    protected $lessonTransformer;

    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
        $this->middleware('auth.basic',['only'=>'store','update']);
    }

    public function index()
    {
        //all()
        //没有提示信息
        //直接展示我们的数据结构
        //没有错误信息

        $lessons = Lesson::all();

        return $this->response([
            'status' => 'success',
            'data'   => $this->lessonTransformer->transformCollection($lessons->toArray())
        ]);
    }

    public function store(Request $request)
    {
        if(!$request->get('title') || !$request->get('body')){
            return $this->setStatusCode(422)->responseNotFound("validate failed");
        }

        Lesson::create($request->all());
        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'message' => 'lesson created'
        ]);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        if(!$lesson){
            return $this->setStatusCode(404)->responseNotFound();
        }
        return $this->response([
            'status' => 'success',
            'data'   => $this->lessonTransformer->transform($lesson->toArray())
        ]);
    }
}
