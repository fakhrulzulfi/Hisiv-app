<?php 

    class Product_in_model {
        private $db;

        public  function __construct() {
            $this->db = new Database;
        }

        public function get($month = null) 
        {
            if( is_null($month) ) {
                $month = date('m');
            }
            else {
                $month = date($month);
            }

            $this->db->query(
                'SELECT 
                    product_in.id AS product_in_id,
                    product_in.qty,
                    product_in.date,
                    product_in.supplier,
                    tb_product.id AS product_id,
                    tb_product.name,
                    tb_product.stock
                FROM 
                    product_in 
                INNER JOIN tb_product 
                    ON tb_product.id = product_in.id_product 
                WHERE
                    MONTH(product_in.date) = :month
                ORDER BY 
                    date DESC'
            );

            $this->db->bind('month', $month);

            return $this->db->resultSet();
        }

        public function getTotalOfProduct()
        {
            $month = date('m');
            $this->db->query(
                'SELECT 
                    SUM(product_in.qty) AS qty
                FROM 
                    product_in
                WHERE
                    MONTH(product_in.date) = :month'
            );

            $this->db->bind('month', $month);

            return $this->db->single();
        }

        public function detailProductIn($id) 
        {
            $this->db->query(
                'SELECT 
                    * 
                FROM 
                    product_in 
                INNER JOIN 
                    tb_product 
                    ON tb_product.id = product_in.id_product 
                WHERE 
                    id_product=:id');
            $this->db->bind('id', $id);

            return $this->db->resultSet();
        }

        public function add($data) 
        {
            $this->db->query('INSERT INTO product_in(qty, date, supplier, id_product) 
                                VALUES(:qty, :date, :supplier, :id_product)');

            $this->db->bind('qty', $data['jumlah_barang']);
            $this->db->bind('date', $data['tanggal']);
            $this->db->bind('supplier', $data['nama_supplier']);
            $this->db->bind('id_product', $data['identifier_product']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function delete($id) 
        {
            $this->db->query('DELETE FROM product_in WHERE id=:id');
            $this->db->bind('id', $id);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function search($month, $key) {

            $this->db->query(
                'SELECT 
                    product_in.id AS product_in_id,
                    product_in.qty,
                    product_in.date,
                    product_in.supplier,
                    tb_product.id AS product_id,
                    tb_product.name,
                    tb_product.stock
                FROM 
                    product_in 
                INNER JOIN tb_product 
                    ON tb_product.id = product_in.id_product 
                WHERE
                    MONTH(product_in.date) = :month AND 
                    tb_product.name LIKE :name
                ORDER BY
                    product_in.date DESC'
            );
            $this->db->bind('month', date('m'));
            $this->db->bind('name', "%$key%");

            return $this->db->resultSet();
        }
        
    }