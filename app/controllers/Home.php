<?php 


    class Home extends Controller {

        public function index() {
            $data['total_product_in'] = $this->model('Product_in_model')->getTotalOfProduct();
            $data['total_product_out'] = $this->model('Product_out_model')->getTotalOfProduct();
            $data['total_product_stock'] = $this->model('Product_model')->getTotalOfProduct();

            $this->view('dashboard/dashboard', $data);
        }
    }