<?php 
    class Barang_keluar extends Controller 
    {
        public function index($month = null) 
        {
            $data['product'] = $this->model('Product_model')->get();
            $data['product_out'] = $this->model('Product_out_model')->get();

            if( !is_null($month) ) {
                $data['product_out'] = $this->model('Product_out_model')->get($month);
            }

            $this->view('barang_keluar/barang_keluar', $data);
        }

        public function keluar()
        {
            if( $this->model('Product_model')->update($_POST['identifier_product'], $_POST['jumlah_barang'], $type = 'min') > 0 ) {
                
                if( $this->model('Product_out_model')->add($_POST) > 0 ) {
                    Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                    header('Location: '. BASE_URL .'/barang_keluar');
                    exit;
                } 
                else {
                    Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                    header('Location: '. BASE_URL .'/barang_keluar');
                    exit;
                }
            } 
            else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: '. BASE_URL .'/barang_keluar');
                exit;
            }
        }

        public function daftar($id = null)
        {
            if( is_null($id) ) {
                $data['product'] = $this->model('Product_out_model')->get();
            } else {
                $data['product'] = $this->model('Product_out_model')->detailProductOut($id);
            }
            
            $this->view('barang_keluar/detail_barang_keluar', $data);
        }

        public function hapus($id, $id_product, $stock)
        {
            if($this->model('Product_out_model')->delete($id) > 0) {
                if( $this->model('Product_model')->update($id_product, $stock, $type = 'plus') > 0 ) {
                    
                    Flasher::setFlash('berhasil', 'dihapus', 'success');
                    header('Location: '. BASE_URL .'/barang_keluar');
                    exit;
                } 
                else {
                    Flasher::setFlash('gagal', 'dihapus', 'danger');
                    header('Location: '. BASE_URL .'/barang_keluar');
                    exit;
                }       
            } 
            else {
                Flasher::setFlash('gagal', 'dihapus', 'danger');
                header('Location: '. BASE_URL .'/barang_keluar');
                exit;
            }
        }

        public function cari() {
            $month = $_POST['bulan'];
            $keyword = $_POST['keyword'];

            $data['product'] = $this->model('Product_model')->get();
            $data['product_out'] = $this->model('Product_out_model')->search($month, $keyword);

            $this->view('barang_keluar/barang_keluar', $data);
        }


        public function laporan()
        {
            $data['product_out'] = $this->model('Product_out_model')->get();
            $data['total_qty'] = $this->model('Product_out_model')->getTotalOfProduct();
            $data['total_price'] = $this->model('Product_out_model')->getTotalPrice();

			$pdf = new FPDF('p','mm','A4');
			// membuat halaman baru
			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->SetFont('Arial','B',14);
			// mencetak string 
            $pdf->Cell(190,8,'HISIV',0,1,'C');
			$pdf->Cell(190,7,'LAPORAN BARANG KELUAR',0,1,'C');
			 
			// Memberikan space kebawah agar tidak terlalu rapat
			$pdf->Cell(10,7,'',0,1);
			 
			$pdf->SetFont('Arial','B',10);
            $pdf->Cell(50,6,'Periode : '.date('F Y'),0,1);
			$pdf->Cell(10,6,'NO.',1,0,'C');
			$pdf->Cell(70,6,'NAMA PRODUK',1,0,'C');
			$pdf->Cell(45,6,'TANGGAL KELUAR',1,0,'C');
			$pdf->Cell(20,6,'QTY',1,0,'C');
			$pdf->Cell(40,6,'HARGA',1,0,'C');
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			 
            $i = 1;
			foreach($data['product_out'] as $row) {
			    $pdf->Cell(10,6,$i,1,0,'C');
			    $pdf->Cell(70,6,$row['name'],1);
			    $pdf->Cell(45,6,$row['date'],1,0,'C'); 
			    $pdf->Cell(20,6,$row['qty'],1,0,'C');
			    $pdf->Cell(40,6,'Rp. '.$row['price'],1,0,'R');
			    $pdf->Ln();
                $i++;
			}

            $pdf->Cell(10,6,'',0,0);
			$pdf->Cell(70,6,'',0,0,'C');
			$pdf->Cell(45,6,'Total : ',0,0,'R');
			$pdf->Cell(20,6,''.$data['total_qty']['qty'],1,0,'C');
			$pdf->Cell(40,6,'Rp. '.$data['total_price']['price'],1,0,'R');
			
			$pdf->Output('D', 'HISIV_Laporan_barang_keluar.pdf', true);
        }
    }