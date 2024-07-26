<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Food_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFood($data) {
        $this->db->insert('food', $data);
        
    }

    function getFood() {
        $this->db->order_by("id", "desc");
        $query = $this->db->get('food');
        return $query->result();
    }

    function getFoodById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('food');
        return $query->row();
    }

    function updateFood($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('food', $data);
    }

    function deleteFood($id) {
        $this->db->where('id', $id);
        $this->db->delete('food');
    }

    public function getProduct()
    {
        // Select only the 'id' and 'name' fields from the 'products' table
        $this->db->select('name');
    $this->db->from('product');
    $query = $this->db->get();
    return $query->result();
    }
    

    public function get_foods() {
        $this->db->select('id, name, InStock');
        $query = $this->db->get('food');
        return $query->result_array();
    }
 
    // public function get_food_by_id($id) {
    //     $this->db->select('id, instock, consumption');
    //     $this->db->from('food');
    //     $this->db->where('id', $id);
    //     $query = $this->db->get();
    //     return $query->row_array();
    // }
    // public function update_quantity($product_name, $new_quantity) {
    //     $this->db->set('quantity', $new_quantity);
    //     $this->db->where('name', $product_name);
    //     $this->db->update('product');
    // }

    
    public function update_instock() {
        $this->db->query("
            UPDATE food f
            JOIN product p ON f.name = p.name
            SET f.InStock = p.quantity
        ");
    }
}
