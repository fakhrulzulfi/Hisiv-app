<?php 

    class Detail_barang extends Controller {
        public function index($id_product) {
            
            $data['product_in'] = $this->model('Product_in_model')->detailProductIn($id_product);
            $data['product_out'] = $this->model('Product_out_model')->detailProductOut($id_product);
            $data['title'] = $this->model('Product_model')->getProductByIdentifier($id_product);

            $this->view('detail_barang/detail_barang', $data);
        }
    }