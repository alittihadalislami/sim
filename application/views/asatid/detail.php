<?php 
    //We initiate a curl session in a variable (resource).
    $curl_handle = curl_init();
    $url = "https://opensheet.elk.sh/13UGg6kaam2IcVV-c9r7WWFv4IBsOffx8gP0GMuEQB8s/email";
    // Now, we set the curl URL option
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    // This option returns data as a string instead of direct output
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    // Execute curl & store data in a variable
    $curl_data = curl_exec($curl_handle);
    curl_close($curl_handle);
    // Decodes the JSON into a PHP array.
    $response_data = json_decode($curl_data);
    // All user data exists in 'data' object.
    $user_data = $response_data;
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
        <?php $id_google_drive = "1K0_51tnlSWYu0jkp1xdS4h7zI1npxuYW"; ?>
        <img class="img-thumbnail mb-4 mx-auto d-block" src="https://drive.google.com/uc?export=view&id=<?= $id_google_drive ?>" width="100px">
        <table class="table table-bordered">
        <thead>
        <tbody>
        <?php 
            foreach ($user_data as $data) {
                if(isset($data->NIY)){
                    if ($data->NIY == $niy) {   
                        foreach ($data as $dt => $isi) {
                            echo '<tr>';
                                echo '<th scope="row">'.$dt.'</th>';
                                echo '<td>'.$isi.'</td>';
                            echo '</tr>';
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

