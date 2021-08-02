<?php 

    class Barang_masuk extends Controller {

        public function index($month = null) 
        {
            $data['product'] = $this->model('Product_model')->get();
            $data['product_in'] = $this->model('Product_in_model')->get();

            if( !is_null($month) ) {
                $data['product_in'] = $this->model('Product_in_model')->get($month);
            }

            $this->view('barang_masuk/barang_masuk', $data);
        }

        public function masuk() 
        {
            if( $this->model('Product_model')->update($_POST['identifier_product'], $_POST['jumlah_barang'], $type = 'plus') > 0) {

                if( $this->model('Product_in_model')->add($_POST) > 0 ) {
                    Flasher::setFlash('berhasil', 'ditambahkan', 'success');
                    header('Location: '. BASE_URL .'/barang_masuk');
                    exit;
                }
                else {
                    Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                    header('Location: '. BASE_URL .'/barang_masuk');
                    exit;
                }
            }
            else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
                header('Location: '. BASE_URL .'/barang_masuk');
                exit;
            }
        }

        public function daftar($id)
        {
            $data['product'] = $this->model('Product_in_model')->detailProductIn($id);
            
            $this->view('barang_masuk/detail_barang_masuk', $data);
        }

        public function hapus($id, $id_product, $stock)
        {
            if($this->model('Product_model')->update($id_product, $stock, $type = 'min') > 0 ) {
                if( $this->model('Product_in_model')->delete($id) > 0 ) {
                    Flasher::setFlash('berhasil', 'dihapus', 'success');
                    header('Location: '. BASE_URL .'/barang_masuk');
                    exit;
                }
                else {
                    Flasher::setFlash('gagal', 'dihapus', 'danger');
                    header('Location: '. BASE_URL .'/barang_masuk');
                    exit;
                }       
            } 
            else {
                Flasher::setFlash('gagal', 'dihapus', 'danger');
                header('Location: '. BASE_URL .'/barang_masuk');
                exit;
            }
        }

        public function cari() {
            $month = $_POST['bulan'];
            $keyword = $_POST['keyword'];

            $data['product'] = $this->model('Product_model')->get();
            $data['product_in'] = $this->model('Product_in_model')->search($month, $keyword);

            $this->view('barang_masuk/barang_masuk', $data);
        }

        public function laporan()
        {
            $data['product_in'] = $this->model('Product_in_model')->get();
            $data['total_qty'] = $this->model('Product_in_model')->getTotalOfProduct();

			$pdf = new FPDF('p','mm','A4');
			// membuat halaman baru
			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->SetFont('Arial','B',14);
			// mencetak string 
            $pdf->Cell(190,8,'HISIV',0,1,'C');
			$pdf->Cell(190,7,'LAPORAN BARANG MASUK',0,1,'C');
			 
			// Memberikan space kebawah agar tidak terlalu rapat
			$pdf->Cell(10,7,'',0,1);
			 
			$pdf->SetFont('Arial','B',10);
            $pdf->Cell(50,6,'Periode : '.date('F Y'),0,1);
			$pdf->Cell(10,6,'NO.',1,0,'C');
			$pdf->Cell(70,6,'NAMA PRODUK',1,0,'C');
			$pdf->Cell(45,6,'TANGGAL MASUK',1,0,'C');
			$pdf->Cell(40,6,'SUPPLIER',1,0,'C');
			$pdf->Cell(20,6,'QTY',1,0,'C');
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			 
            $i = 1;
			foreach($data['product_in'] as $row) {
			    $pdf->Cell(10,6,$i,1,0,'C');
			    $pdf->Cell(70,6,$row['name'],1);
			    $pdf->Cell(45,6,$row['date'],1,0,'C');
			    $pdf->Cell(40,6,$row['supplier'],1,0);
			    $pdf->Cell(20,6,$row['qty'],1,0,'C');
			    $pdf->Ln();
                $i++;
			}

            $pdf->Cell(10,6,'',0,0);
			$pdf->Cell(70,6,'',0,0,'C');
			$pdf->Cell(45,6,'',0,0,'R');
			$pdf->Cell(40,6,'Total : ',0,0,'R');
			$pdf->Cell(20,6,''.$data['total_qty']['qty'],1,0,'C');
			
			$pdf->Output('D', 'HISIV_Laporan_barang_masuk.pdf', true);
        }
    }