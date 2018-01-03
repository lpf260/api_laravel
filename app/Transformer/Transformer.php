<?php
/**
 * Created by PhpStorm.
 * User: lpf
 * Date: 2018/1/3
 * Time: 13:55
 */

namespace App\Transformer;


abstract class Transformer
{
    /**
     * @param $items
     * @return array
     */
    public function transformCollection($items)
    {
        return array_map([$this,'transform'],$items);
    }

    /**
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);
}