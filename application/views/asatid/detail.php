<?php 
    //data detai
    $curl_handle = curl_init();
    $url = "https://opensheet.elk.sh/13UGg6kaam2IcVV-c9r7WWFv4IBsOffx8gP0GMuEQB8s/email";
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    $curl_data = curl_exec($curl_handle);
    curl_close($curl_handle);
    $response_data = json_decode($curl_data);
    $user_data = $response_data;

    //data foto
    $curl_handle = curl_init();
    $url = "https://opensheet.elk.sh/1n8meZ0zwfE3MsR6qEU3eRnw9HGOlDSseDgjsap6h548/1";
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    $curl_data = curl_exec($curl_handle);
    curl_close($curl_handle);
    $response_foto = json_decode($curl_data);
?>
<div class="content-wrapper">
  <section class="content" style="baca">
    <div class="row">
      <div class="col px-5">
        <div class="card card-light mt-5">
          <div class="card-header">
            <i class="fa fa-edit"></i> &nbsp
            <span class="card-title" >Detail Civitas Ma'had</span>
          </div>
        </div>
        <?php 
            $id_google_drive = "1eqhNKwfJb7XprjsOdBX5RgNInvqR4LNH";
            foreach ($response_foto as  $value) {
                $data_foto = explode(".",$value->nama_file)[0];
                if ($data_foto == $this->uri->segment(3) ) {
                    $id_google_drive = $value->id_file;
                }
            }
        ?>
        <img class="img-thumbnail mb-4 mx-auto d-block" src="https://drive.google.com/thumbnail?id=<?= $id_google_drive ?>" width="150px">
        <table class="table table-bordered">
        <thead>
        <tbody>
        <?php 
            foreach ($user_data as $data) {
                if(isset($data->NIY)){
                    if ($data->NIY == $niy) {   
                        foreach ($data as $dt => $isi) {
                            if ($isi != "" && $dt != "NO" ) {
                                echo '<tr>';
                                    echo '<th scope="row">'.$dt.'</th>';
                                    echo '<td>'.$isi.'</td>';
                                echo '</tr>';
                            }
                        }
                    }
                }
            }
            ?>
        </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

