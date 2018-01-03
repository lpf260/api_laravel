<?php
/**
 * Created by PhpStorm.
 * User: lpf
 * Date: 2018/1/3
 * Time: 16:30
 */

namespace App\Api\Transformers;


use League\Fractal\TransformerAbstract;
use App\Lesson;

class LessonTransformer extends TransformerAbstract
{
    public function transform(Lesson $lesson)
    {
        return [
            'title'     => $lesson['title'],
            'content'   => $lesson['body'],
            'is_free'   => (boolean)$lesson['free']
        ];
    }
}