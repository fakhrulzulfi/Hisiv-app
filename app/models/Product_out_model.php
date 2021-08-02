<?php 

    class Product_out_model {
        private $db;

        public  function __construct() 
        {
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
                    product_out.id AS product_out_id,
                    product_out.qty,
                    product_out.price,
                    product_out.date,
                    tb_product.id AS product_id,
                    tb_product.name,
                    tb_product.stock
                FROM 
                    product_out 
                INNER JOIN 
                    tb_product 
                    ON tb_product.id = product_out.id_product
                WHERE
                    MONTH(product_out.date) = :month
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
                    SUM(product_out.qty) AS qty
                FROM 
                    product_out
                WHERE
                    MONTH(product_out.date) = :month '
            );

            $this->db->bind('month', $month);

            return $this->db->single();
        }

        public function getTotalPrice() {
            $month = date('m');
            $this->db->query(
                'SELECT 
                    SUM(product_out.price) AS price
                FROM 
                    product_out
                WHERE
                    MONTH(product_out.date) = :month '
            );

            $this->db->bind('month', $month);

            return $this->db->single();
        }

        public function detailProductOut($id) 
        {
            $this->db->query(
                'SELECT 
                    product_out.id AS product_out_id,
                    product_out.qty,
                    product_out.price,
                    product_out.date,
                    tb_product.id AS product_id,
                    tb_product.name,
                    tb_product.stock
                FROM 
                    product_out 
                INNER JOIN 
                    tb_product 
                    ON tb_product.id = product_out.id_product 
                WHERE 
                    id_product=:id'
            );
            $this->db->bind('id', $id);

            return $this->db->resultSet();
        }

        public function add($data) 
        {
            $this->db->query('INSERT INTO product_out(qty, price, date, id_product) 
                                VALUES(:qty, :price, :date, :id_product)');

            $this->db->bind('qty', $data['jumlah_barang']);
            $this->db->bind('price', $data['price']);
            $this->db->bind('date', $data['tanggal']);
            $this->db->bind('id_product', $data['identifier_product']);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function delete($id) 
        {
            $this->db->query('DELETE FROM product_out WHERE id=:id');
            $this->db->bind('id', $id);

            $this->db->execute();

            return $this->db->rowCount();
        }

        public function search($month, $key) {

            $this->db->query(
                'SELECT
                    product_out.id AS product_out_id,
                    product_out.qty,
                    product_out.price,
                    product_out.date,
                    tb_product.id AS product_id,
                    tb_product.name,
                    tb_product.stock
                FROM 
                    product_out 
                INNER JOIN 
                    tb_product 
                    ON tb_product.id = product_out.id_product
                WHERE
                    MONTH(product_out.date) = :month AND 
                    tb_product.name LIKE :name
                ORDER BY
                    product_out.date DESC'
            );
            $this->db->bind('month', date('m'));
            $this->db->bind('name', "%$key%");

            return $this->db->resultSet();
        }

    }