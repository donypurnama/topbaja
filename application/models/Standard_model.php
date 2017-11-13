<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Standard_model extends CI_Model {

    function __construct(){
        parent :: __construct();
    }

    public function search ($fields = null, $conditions = [], $table = null, $order = null, $order_value = "DESC", $limit = null) {
        if ($fields && $table) {
            $this->db->select($fields);
            $this->db->from($table);

            if ($conditions) {
                $this->db->like($conditions);
            }
            if ($order) {
                $this->db->order_by($order, $order_value);
            }
            if ($limit) {
                $this->db->limit($limit);
            }
            return $this->db->get()->result_array();
        } else return false;
    }

    public function search_products ($query = null, $limit = null, $offset = null) {
        if ($query) {
            $this->db->select("products.product_id, products.product_url, products.product_name, products.product_primary_image, products.product_price, products.product_discount");
            $this->db->from("products");
            $this->db->join("brands", "brands.brand_id = products.brand_id", "left");
            $this->db->join("categories", "categories.category_id = products.category_id", "left");
            $this->db->join("types", "types.type_id = products.type_id", "left");
            $this->db->like([
              "categories.category_name" => $query
            ])->or_like([
              "types.type_name" => $query
            ])->or_like([
              "brands.brand_name" => $query
            ])->or_like([
              "products.product_name" => $query
            ]);

            if ($limit) {
              $this->db->limit($limit, $offset);
            }
            return $this->db->get()->result_array();
        } else return false;
    }

    public function get ($fields = null, $conditions = [], $table = null, $order = null, $order_value = "DESC", $limit = null, $offset = 0) {
        if ($fields && $table) {
            $this->db->select($fields);
            $this->db->from($table);

            if ($conditions) {
                $this->db->where($conditions);
            }
            if ($order) {
                $this->db->order_by($order, $order_value);
            }
            if ($limit) {
                $this->db->limit($limit, $offset);
            }
            return $this->db->get()->result_array();
        } else return false;
	}

  public function get_join ($field = null, $table = null, $join_table = null, $on_key = null, $conditions = [], $order = null, $order_value = "DESC", $limit = null, $offset = 0, $additional_condition = null) {
    if ($field && $table && $join_table && $on_key) {
      $this->db->select($field);
      $this->db->from($table);
      $this->db->join($join_table, $on_key, 'inner');

      if ($conditions) {
        $this->db->where($conditions);
        if ($additional_condition !== null) {
          $this->db->where("($additional_condition)");
        }
      }
      if ($order) {
          $this->db->order_by($order, $order_value);
      }
      if ($limit) {
          $this->db->limit($limit, $offset);
      }

      return $this->db->get()->result_array();
    } else return false;
  }

  public function get_double_join ($field = null, $table = null, $join_table1 = null, $join_table2 = null, $on_key1 = null, $on_key2 = null, $conditions = [], $order = null, $order_value = "DESC", $limit = null, $offset = 0, $additional_condition = null) {
    if ($field && $table && $join_table1 && $join_table2 && $on_key1 && $on_key2) {
      $this->db->select($field);
      $this->db->from($table);
      $this->db->join($join_table1, $on_key1, 'inner');
      $this->db->join($join_table2, $on_key2, 'inner');

      if ($conditions) {
        $this->db->where($conditions);
        if ($additional_condition !== null) {
          $this->db->where("($additional_condition)");
        }
      }
      if ($order) {
          $this->db->order_by($order, $order_value);
      }
      if ($limit) {
          $this->db->limit($limit, $offset);
      }

      return $this->db->get()->result_array();
    } else return false;
  }

  public function get_join_group ($field = null, $table = null, $join_table = null, $on_key = null, $conditions = [], $order = null, $order_value = "DESC", $group = null, $limit = null) {
    if ($field && $table && $join_table && $on_key) {
      $this->db->select($field);
      $this->db->from($table);
      $this->db->join($join_table, $on_key, 'inner');

      if ($conditions) {
        $this->db->where($conditions);
      }
      if ($order) {
        $this->db->order_by($order, $order_value);
      }
      if ($limit) {
        $this->db->limit($limit);
      }
      if ($group) {
        $this->db->group_by($group);
      }
      return $this->db->get()->result_array();
    } else return false;
  }

  public function find ($fields = null, $conditions = [], $table = null) {
        if ($fields && $conditions && $table) {
            $this->db->select($fields);
            $this->db->from($table);
            $this->db->where($conditions);

            return $this->db->get()->row_array();
        } else return false;
	}

  public function find_join ($field = null, $table = null, $join_table = null, $on_key = null, $conditions = [], $order = null, $order_value = "DESC", $limit = null, $offset = 0, $additional_condition = null) {
    if ($field && $table && $join_table && $on_key) {
      $this->db->select($field);
      $this->db->from($table);
      $this->db->join($join_table, $on_key, 'inner');

      if ($conditions) {
        $this->db->where($conditions);
        if ($additional_condition !== null) {
          $this->db->where("($additional_condition)");
        }
      }
      if ($order) {
          $this->db->order_by($order, $order_value);
      }
      if ($limit) {
          $this->db->limit($limit);
      }

      return $this->db->get()->row_array();
    } else return false;
  }


    public function find_double_join ($field = null, $table = null, $join_table1 = null, $join_table2 = null, $on_key1 = null, $on_key2 = null, $conditions = []) {
    if ($field && $table && $join_table1 && $join_table2 && $on_key1 && $on_key2) {
      $this->db->select($field);
      $this->db->from($table);
      $this->db->join($join_table1, $on_key1, 'inner');
      $this->db->join($join_table2, $on_key2, 'inner');

      if ($conditions) {
        $this->db->where($conditions);
      }

      return $this->db->get()->row_array();
    } else return false;
  }


    public function insert ($data = [], $table = null) {
        if ($data && $table) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        } else return false;
    }

    public function insert_batch ($data = [], $table = null) {
        if ($data && $table) {
            return $this->db->insert_batch($table, $data);
        } else return false;
    }

    public function update ($data = [], $table = null, $where = []) {
        if ($data && $table && $where) {
            return $this->db->update($table, $data, $where);
        } else return false;
    }

    public function update_count ($field = null, $table = null, $where = [], $qty = null) {
        if ($field && $table && $where) {
          if ($qty) {
            $this->db->set($field, $qty, FALSE);
          } else {
            $this->db->set($field, "$field+1", FALSE);
          }
          $this->db->where($where);
          return $this->db->update($table);
        }

        else return false;
    }

    public function delete ($where = [], $table = null) {
        if ($where && $table) {
            return $this->db->delete($table, $where);
        } else return false;
    }

    public function delete_multiple ($field = null, $where = [], $params = [], $table = null) {
      if ($field && $params && $table && $where) {
        $this->db->where_in($field, $params);
        $this->db->where($where);
        return $this->db->delete($table);
      } else return false;
    }
}
