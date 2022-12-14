<?php

namespace MinhHN\Collection;

use Exception;

class Collection
{
    public function all(){
        return $this->data;
    }

    public function first(){
        return reset($this->data);
    }

    public function last(){
        return end($this->data);
    }

    /**
     * @throws Exception
     */
    public function filter($key, $sign, $value){
        $itmes = [];
        if(isset($this->data[0]->$key)){
            $n = count($this->data);
            if($sign == "<"){
                foreach ($this->data as $data){
                    if($data->$key < $value){
                        $itmes[] = $data;
                    }
                }
            }
            if($sign == ">"){
                foreach ($this->data as $data){
                    if($data->$key > $value){
                        $itmes[] = $data;
                    }
                }
            }
            if($sign == "="){
                foreach ($this->data as $data){
                    if($data->$key == $value){
                        $itmes[] = $data;
                    }
                }
            }
            return $itmes;
        }
        else{
            throw new Exception("Khong tim thay $key");
        }
    }

//    public function map(callable $callback){
//        $items = $this->all();
//        $keys = array_keys($items);
//
//        $items = array_map($callback, $items, $keys);
////        return $items;
//        return new static(array_combine($keys, $items));
//    }

//    public function map(\Closure $callback)
//    {
//        return $this->createFrom(array_map($callback, $this->elements));
//    }

    /**
     * @throws Exception
     */
    public function avg($value){
        if(isset($this->data[0]->$value) && is_numeric($this->data[0]->$value)){
            $n = count($this->data);
            $sum = 0;
            $avg = 0;
            for($i = 0; $i < $n; $i++){
                $sum = $sum + $this->data[$i]->$value;
            }
            $avg = $sum/$n;
            return round($avg, 4);
        }
        else {
            throw new Exception('Du lieu nhap vao khong dung dinh dang');
        }
    }

    public function pluck($key){
        $items = [];
        if(isset($this->data[0]->$key)){
            foreach ($this->data as $data){
                $items[] = $data->$key;
            }
            return $items;
        }
        else{
            throw new Exception("Khong tim thay $key trong du lieu");
        }
    }

    /**
     * @throws Exception
     */
    public function sortBy($key){
        $key = strtolower($key);
        if($key == "asc"){
            for($i = 0; $i < count($this->data); $i++){
                for ($j = $i; $j< count($this->data); $j++){
                    if($this->data[$i]->age > $this->data[$j]->age){
                        $temp = $this->data[$i]->age;
                        $this->data[$i]->age = $this->data[$j]->age;
                        $this->data[$j]->age = $temp;
                    }
                }
            }
        }
        elseif($key == "desc"){
            for($i = count($this->data) - 1; $i>=0; $i--){
                for ($j = $i ; $j >= 0; $j--){
                    if($this->data[$i]->age > $this->data[$j]->age){
                        $temp = $this->data[$i]->age;
                        $this->data[$i]->age = $this->data[$j]->age;
                        $this->data[$j]->age = $temp;
                    }
                }
            }
        }
        else{
            throw new Exception("Gia tri nhap vao chi co the la asc(tang dan) va desc(giam dan)");
        }
        return $this->data;
    }
}