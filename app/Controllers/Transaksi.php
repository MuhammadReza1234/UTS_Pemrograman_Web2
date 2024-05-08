<?php
namespace App\Controllers;

use TCPDF;

class Transaksi extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->validation = \Config\Services::validation();
		$this->session = session();
		$this->email = \Config\Services::email();
	}

	public function view()
	{
		$id = $this->request->uri->getSegment(3);

		$transaksiModel = new \App\Models\TransaksiModel();
		$transaksi = $transaksiModel->select('*, transaksi.id AS id_trans')->join('barang', 'barang.id=transaksi.id_barang')
					->join('user', 'user.id=transaksi.id_pembeli')
					->where('transaksi.id', $id)
					->first();

		return view('transaksi/view',[
			'transaksi'=>$transaksi,
		]);
	}

	public function index(){
		$transaksiModel = new \App\Models\TransaksiModel();
		$model = $transaksiModel->findAll();
		return view('transaksi/index',[
			'model' => $model,
		]);
	}

	public function invoice()
	{
		$id = $this->request->uri->getSegment(3);

		$transaksiModel = new \App\Models\TransaksiModel();
		$transaksi = $transaksiModel->find($id);

		$userModel = new \App\Models\UserModel();
		$pembeli = $userModel->find($transaksi->id_pembeli);

		$barangModel = new \App\Models\BarangModel();
		$barang = $barangModel->find($transaksi->id_barang);

		$html = view('transaksi/invoice',[
			'transaksi'=> $transaksi,
			'pembeli' => $pembeli,
			'barang' => $barang,
		]);

		$pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('PALUGADA SHOP');
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('invoice.pdf', 'I');
		
	}

	public function sendEmail()
	{
		$this->email->setFrom('chaerulhiudayat@mhs.pelitabangsa.ac.id','chaerulhidayat70@gmail.com');
		$this->email->setTo('chaerulhidayat70@gmail.com');

		$this->email->setSubject('Testing Kirim Email');

		$this->email->setMessage('<h1>Tes Email</h1><p>Ini tes email</p>');

		if(! $this->email->send()){
			return false;
		}else{
			return true;
		}
	}
}	