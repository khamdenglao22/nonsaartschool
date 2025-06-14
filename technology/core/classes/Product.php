<?php


class Product extends Database
{


    private $id;
    private $code;
    private $name;
    private $description;
    private $product_img;
    private $category_id;
    private $unit_id;
    private $base_price;
    private $sale_price;
    private $qty;
    private $discount;
    private $created;
    private $created_user;




    public function getLoadProduct($text_search, $start, $limit){

        if ($text_search != "") {
            $this->query("SELECT p.*, p.name AS product_name,u.name AS unit_name,c.name AS category_name FROM `tb_product` p INNER JOIN tb_unit u ON p.unit_id= u.id INNER JOIN tb_category c ON p.category_id = c.id AND  (p.`name` LIKE '%" . $text_search . "%' ) ORDER BY p.`id` DESC LIMIT $start, $limit ");
        } else {
            $this->query("SELECT p.*, p.name AS product_name,u.name AS unit_name,c.name AS category_name FROM `tb_product` p INNER JOIN tb_unit u ON p.unit_id= u.id INNER JOIN tb_category c ON p.category_id = c.id ORDER BY p.`id` DESC LIMIT $start,  $limit ");
        }
        return $this->resultset();

    }
    public function VeiwProduct(){
        $this->query("SELECT p.*, p.name AS product_name,u.name AS unit_name,c.name AS category_name FROM `tb_product` p INNER JOIN tb_unit u ON p.unit_id= u.id INNER JOIN tb_category c ON p.category_id = c.id WHERE p.id=:id");
        $this->bind('id', $this->id);
        return $this->single();
    }
    public function DeleteProduct(){
        $this->beginTransaction();
        try {
            $this->query("DELETE FROM `tb_product` WHERE `id`=:id");
            $this->bind('id', $this->id);
            $result = $this->execute();

            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }
    public function UpdateProduct(){

        $this->beginTransaction();
        try {
            $this->query("UPDATE `tb_product` SET `code`=:code, `name`=:name, `description`=:description, `product_img`=:product_img, `unit_id`=:unit_id, `category_id`=:category_id, `base_price`=:base_price, `sale_price`=:sale_price , `qty`=:qty, `discount`=:discount, `updated`=:created, `updated_user`=:created_user WHERE  `id`=:id");
            $this->bind('id', $this->id);
            $this->bind('code', $this->code);
            $this->bind('name', $this->name);
            $this->bind('description', $this->description);
            $this->bind('product_img', $this->product_img);
            $this->bind('unit_id', $this->unit_id);
            $this->bind('category_id', $this->category_id);
            $this->bind('base_price', $this->base_price);
            $this->bind('sale_price', $this->sale_price);
            $this->bind('qty', $this->qty);
            $this->bind('discount', $this->discount);
            $this->bind('created', $this->created);
            $this->bind('created_user', $this->created_user);
            $result = $this->execute();
            $this->endTransaction();
        } catch (PDOException $e) {
            $result = $e;
            $this->cancelTransaction();
        }
        return $result;
    }
    public function getLoadProductCount($text_search){
        if ($text_search != "") {
            $this->query("SELECT p.*, p.name AS product_name,u.name AS unit_name,c.name AS category_name FROM `tb_product` p INNER JOIN tb_unit u ON p.unit_id= u.id INNER JOIN tb_category c ON p.category_id = c.id AND  (p.`name` LIKE '%" . $text_search . "%' ) ORDER BY p.`id` DESC");
        } else {
            $this->query("SELECT p.*, p.name AS product_name,u.name AS unit_name,c.name AS category_name FROM `tb_product` p INNER JOIN tb_unit u ON p.unit_id= u.id INNER JOIN tb_category c ON p.category_id = c.id ORDER BY p.`id` DESC LIMIT 1000 ");
        }
        return $this->resultset();

    }
    public function AddProduct(){
            $this->beginTransaction();
            try {
                $this->query("INSERT INTO `tb_product`(`code`,`name`,`description`,`product_img`,`unit_id`,`category_id`,`base_price`,`sale_price`,`qty`,`discount`,`created`,`created_user`) VALUES (:code, :name, :description, :product_img, :unit_id, :category_id, :base_price, :sale_price, :qty, :discount, :created, :created_user)");
                $this->bind('code', $this->code);
                $this->bind('name', $this->name);
                $this->bind('description', $this->description);
                $this->bind('product_img', $this->product_img);
                $this->bind('unit_id', $this->unit_id);
                $this->bind('category_id', $this->category_id);
                $this->bind('base_price', $this->base_price);
                $this->bind('sale_price', $this->sale_price);
                $this->bind('qty', $this->qty);
                $this->bind('discount', $this->discount);
                $this->bind('created', $this->created);
                $this->bind('created_user', $this->created_user);

                $result = $this->execute();
                $this->endTransaction();
            } catch (PDOException $e) {
                $result = $e;
                $this->cancelTransaction();
            }
            return $result;

    }
    public function getCategory(){
        $this->query("SELECT * FROM `tb_category`");
        return $this->resultset();
    }

    public function getUnit(){
        $this->query("SELECT * FROM `tb_unit`");
        return $this->resultset();
    }
    public function SetId($id){
        return $this->id =$id;
    }
    public function SetName($name){
        return $this->name = $name;
    }

    public function SetCode($code){
        return $this->code = $code;
    }
    public function SetDescription($description){
        return $this->description = $description;
    }
    public function SetImg($product_img){
        return $this->product_img = $product_img;
    }
    public function SetCategory($category_id){
        return $this->category_id = $category_id;
    }
    public function SetUnit($unit_id){
        return $this->unit_id = $unit_id;
    }
    public function SetBasePrice($base_price){
        return $this->base_price = $base_price;
    }
    public function SetSalePrice($sale_price){
        return $this->sale_price = $sale_price;
    }
    public function SetQty($qty){
        return $this->qty = $qty;
    }
    public function SetDiscount($discount){
        return $this->discount = $discount;
    }
    public function SetCreated($created){
        return $this->created = $created;
    }
    public function SetCreateUser($created_user){
        return $this->created_user = $created_user;

    }



}