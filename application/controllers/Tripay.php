<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tripay extends CI_Controller {

	public function index(){
		// $produk = [['sku'=>'B01','name'=>'Aplikasi Marketplace','price'=>155000,'quantity'=>1]];
        // print_r($this->tripay->createPayment("INV123456","BRIVA",500000,["nama"=>"susanto","email"=>"dewabilly@gmail.com","nohp"=>"085691257411"]));
        // print_r($this->tripay->cekPayment("DEV-5RNIMBg0BH3waDUCADKm2c4zUKeQ7wiNAw55A4gh"));
	}

	function bayarpesanan(){
		cek_session_members();
		if(isset($_GET["metode"])){
			$trx = $this->uri->segment('3');
			$auto = $this->db->query("SELECT a.nominal, b.id_pembeli, c.nama_lengkap, c.email, c.no_hp FROM `rb_penjualan_otomatis` a JOIN rb_penjualan b ON a.kode_transaksi=b.kode_transaksi 
						JOIN rb_konsumen c ON b.id_pembeli=c.id_konsumen where a.kode_transaksi='$trx' GROUP BY b.id_pembeli")->row_array();
			if ($auto['id_pembeli']==$this->session->id_konsumen){
				$produk = [['sku'=>$trx,'name'=>"Pembayaran Invoice #".$trx,'price'=> $auto['nominal'],'quantity'=>1]];
				$pembeli = ['nama'=>$auto['nama_lengkap'],'email'=>$auto['email'],'nohp'=>$auto['no_hp']];

				$res = $this->tripay->createPayment($trx,$_GET["metode"],$auto['nominal'],$pembeli,$produk);

				if($res->success == true){
					//echo json_encode(array("success"=>true,"msg"=>"Success","token"=>$this->security->get_csrf_hash()));
					redirect('konfirmasi/tracking/'.$trx.'?success');
				}else{
					echo json_encode(array("success"=>false,"msg"=>"Gagal memproses pembayaran","token"=>$this->security->get_csrf_hash()));
				}
			}else{
				echo json_encode(array("success"=>false,"msg"=>"Gagal memproses pembayaran","token"=>$this->security->get_csrf_hash()));
			}
		}else{
			echo json_encode(array("success"=>false,"msg"=>"Gagal memproses pembayaran","token"=>$this->security->get_csrf_hash()));
		}
	}

	function webhook(){
		$json = file_get_contents("php://input");
		$set = $this->func->globalset("semua");
		
		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';
		$signature = hash_hmac('sha256', $json, $set->private_key);

		if( $callbackSignature !== $signature ) {
			echo json_encode(array("success"=>false,"msg"=>"Forbidden Access"));
			exit();
		}

		$data = json_decode($json);
		$event = $_SERVER['HTTP_X_CALLBACK_EVENT'];

		if( $event == 'payment_status' ){
			if( $data->status == 'PAID' ){
				$datas = array(
                    "status"=> $data->status,
                    "paid_at"=> $data->paid_at,
					"webhook_response"=> $json,
                    "statusbayar"=> 1
                );
                $this->db->where("reference",$data->reference);
                $this->db->update("rb_tripay",$datas);
				$tr = $this->db->query("SELECT kode_transaksi FROM rb_penjualan_otomatis where catatan='".$data->reference."")->row_array();
				$cek_digital = $this->db->query("SELECT if(c.produk_file is null,'0','1') as pf FROM `rb_penjualan_detail` a JOIN rb_penjualan b ON a.id_penjualan=b.id_penjualan 
													JOIN rb_produk c ON a.id_produk=c.id_produk
														where b.kode_transaksi='$tr[kode_transaksi]' AND c.jenis_produk='Digital' GROUP BY pf")->num_rows();
				if ($cek_digital=='1'){
					$proses = '3'; 
				}else{
					$proses = '2'; 
				}

				$datax = array('pembayaran'=>1);
				$where = array('catatan' =>$data->reference);
				$this->model_app->update('rb_penjualan_otomatis', $datax, $where);

				$data_idp = array('proses'=>$proses);
				$where_idp = array('kode_transaksi'=>$tr['kode_transaksi'],'status_pembeli'=>'konsumen');
				$this->model_app->update('rb_penjualan', $data_idp, $where_idp);
			}
			echo json_encode(["success"=>true,"payment_status"=>$data->status]);
		}else{
			echo json_encode(["success"=>false,"msg"=>"transaction not found"]);
		}
	}

	function tes(){
		print_r($this->tripay->metode('semua'));
	}
}
