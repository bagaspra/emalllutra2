<?php 
if ($this->input->post('id')=='1'){
    echo "<div id='transfer' style='padding:0px 10px 10px 10px'>
    <center><i><b style='color:red'>Catatan</b> : Transfer tepat hingga 3 digit terakhir.</i></center><br>
        <div class='alert alert-success' style='border-left:3px solid; margin-bottom:15px; background-color: #ffffff;'><b>Silahkan Transfer Langsung ke</b></div>
        <div style='height:250px; overflow:scroll'>
        <dl style='padding:0px 10px 10px 10px'>";
            $nooo = 1;
            $rekening = $this->model_app->view('rb_rekening');
            foreach ($rekening->result_array() as $row){
                echo "<img style='max-width: 100px; float: left; margin-right:7px; border: 1px solid #c1c1c1;' src='".base_url()."asset/images/$row[gambar]'>
                <dt>$row[nama_bank]</dt>
                    <dd style='border-bottom:1px dotted #cecece; margin-bottom:10px'>$row[pemilik_rekening], <span class='rekening$nooo'><input class='pull-right rekeningx' style='border: 1px solid #cecece; padding: 0px 10px; margin-top: -10px;' onClick=\"this.select();\" type='text' value='$row[no_rekening]' readonly='on'></span></dd>";
                $nooo++;
            }
        echo "</dl>
        </div>
        <br><a class='ps-btn ps-btn--outline ps-btn--fullwidth manual' style='margin-bottom:5px; padding:5px 10px' href='#' data-toggle='modal' data-target='#pembayaran' data-dismiss='modal'>Kembali</a>
    </div>";
}elseif ($this->input->post('id')=='2'){
    echo "<div id='tripay' style='padding:0px 10px 10px 10px'>
        <div class='alert alert-success' style='border-left:3px solid; margin-bottom:15px; background-color: #ffffff;'><b>Pilih Channel Pembayaran</b></div>
        <div style='height:250px; overflow:scroll'>
        <dl style='padding:0px 10px 10px 10px'>";
            foreach ($this->tripay->metode() as $key => $val) {
                echo "<a class='unlink' href='".base_url()."tripay/bayarpesanan/$invoice?metode=$val[kode]'>
                <div style='cursor:pointer'>
                    <img style='max-width: 100px; float: left; margin-right:7px; border: 1px solid #c1c1c1;' src='$val[logo]'>
                    <dt>$val[nama] <i class='fa fa-angle-right pull-right'></i></dt>
                    <span style='color:#8a8a8a'>+ Fee Trx. Rp ".rupiah($val['biaya'])."</span>
                </div></a>
                <div style='clear:both; padding:5px; margin-bottom:5px; border-bottom:1px dotted #e3e3e3'></div>";
            }
        echo "</dl>
        </div>
        <br><a class='ps-btn ps-btn--outline ps-btn--fullwidth manual' style='margin-bottom:5px; padding:5px 10px' href='#' data-toggle='modal' data-target='#pembayaran' data-dismiss='modal'>Kembali</a>
    </div>";
}
?>