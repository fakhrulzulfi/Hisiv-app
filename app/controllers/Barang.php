<?php 

    class Barang extends Controller {
        public function index() {
            $data['product'] = $this->model('Product_model')->get();
            $this->view('stok_barang/stok_barang', $data);
        }

        public function cari() 
        {
            $keyword = $_POST['keyword'];

            $data['product'] = $this->model('Product_model')->search($keyword);

            $this->view('stok_barang/stok_barang', $data);
        }

        public function laporan()
        {
            $data['product'] = $this->model('Product_model')->get();
            $data['total_qty'] = $this->model('Product_model')->getTotalOfProduct();

			$pdf = new FPDF('p','mm','A4');
			// membuat halaman baru
			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->SetFont('Arial','B',14);
			// mencetak string 
            $pdf->Cell(190,8,'HISIV',0,1,'C');
			$pdf->Cell(190,7,'LAPORAN STOK BARANG',0,1,'C');
			 
			// Memberikan space kebawah agar tidak terlalu rapat
			$pdf->Cell(10,7,'',0,1);
			 
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(40,6,'',0,0);
            $pdf->Cell(50,6,'Periode : '.date('F Y'),0,0);
            $pdf->Ln();
			$pdf->Cell(40,6,'',0,0);
            $pdf->Cell(15,6,'NO.',1,0,'C');
			$pdf->Cell(75,6,'NAMA PRODUK',1,0,'C');
			$pdf->Cell(25,6,'QTY',1,0,'C');
			$pdf->Ln();
			$pdf->SetFont('Arial','',10);
			 
            $i = 1;
			foreach($data['product'] as $row) {
    			$pdf->Cell(40,6,'',0,0);
			    $pdf->Cell(15,6,$i,1,0,'C');
			    $pdf->Cell(75,6,$row['name'],1);
			    $pdf->Cell(25,6,$row['stock'],1,0,'C');
			    $pdf->Ln();
                $i++;
			}

            $pdf->Cell(40,6,'',0,0);
            $pdf->Cell(15,6,'',0,0);
            $pdf->Cell(75,6,'Total : ',0,0,'R');
            $pdf->Cell(25,6,$data['total_qty']['stock'],1,0,'C');
			
			$pdf->Output('D', 'HISIV_Laporan_stok_barang.pdf', true);
        }
        
        
    }