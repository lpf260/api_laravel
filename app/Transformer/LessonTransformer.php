<?php
/**
 * Created by PhpStorm.
 * User: lpf
 * Date: 2018/1/3
 * Time: 14:00
 */

namespace App\Transformer;


class LessonTransformer extends Transformer
{
    /**
     * @param $lesson
     * @return array
     */
    public function transform($lesson)
    {
        return [
            'title'     => $lesson['title'],
            'content'   => $lesson['body'],
            'is_free'   => (boolean)$lesson['free']
        ];
    }
}