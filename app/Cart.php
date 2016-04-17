<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 17/04/2016
 * Time: 12:43
 */

namespace CodeCommerce;


class Cart
{

    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add($id, $name, $price){

        $this->items + [
          $id =>[
              'qtd' => isset($this->items[$id]['qtd']) ? $this->items[$id]['qtd']++ : 1,
              'price' => $price,
              'name' => $name

          ]

        ];

    }


    public function remove($id){
        unset($this->items[$id]);
    }


    public function all($id){
        return $this->items;
    }

    public function getTotal(){
        $total = 0;
        foreach ($this->items as $items){
            $total += $items['qtd']*$items['price'];
        }

        return $total;
    }



    //add, remove, all, getTotal




}