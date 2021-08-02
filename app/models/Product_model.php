<?php 

    class Product_model {
        private $db;

        public  function __construct() {
            $this->db = new Database;
        }

        public function get() {
            $this->db->query('SELECT * FROM tb_product');
        
            return $this->db->resultSet();
        }

        public function getProductByIdentifier($id) {
            $this->db->query('SELECT * FROM tb_product WHERE id=:id');
            $this->db->bind('id', $id);

            return $this->db->single();
        }

        public function getTotalOfProduct()
        {
            $this->db->query(
                'SELECT 
                    SUM(tb_product.stock) AS stock
                FROM 
                    tb_product'
            );

            return $this->db->single();
        }

        public function update($id_product, $stock, $type) {
            $data = $this->getProductByIdentifier($id_product);
            $stock_in_db = $data['stock'];

            if( $type == 'plus' ) {
                $stock_now = $stock_in_db + $stock;
            } elseif ( $type == 'min' ) {  // MASIH BUG, BISA MINUS STOKNYA
                if( $stock_in_db < $stock ) {
                    return 0;
                } else {
                    $stock_now = $stock_in_db - $stock;
                }
            }

            $this->db->query('UPDATE tb_product SET stock = :stock WHERE id = :id_product');
            $this->db->bind('stock', $stock_now);
            $this->db->bind('id_product', $id_product);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function search($key) {

            $this->db->query(
                'SELECT 
                    *
                FROM
                    tb_product
                WHERE 
                    tb_product.name LIKE :name'
            );
            $this->db->bind('name', "%$key%");

            return $this->db->resultSet();
        }
    }