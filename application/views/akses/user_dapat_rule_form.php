<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<?php 
    $this->load->view('templates/header_hc');
?>

        <div class="card card-success">
          <div class="card-header">
            <?php echo $button ?>
          </div>
          <div class="card-body">
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group pr-3">
                    <label for="user_id">User <?php echo form_error('user[]') ?></label>
                    <select class="form-control basic-multiple" name="user[]" id="user" multiple="multiple">
                      <?php foreach ($user as $u): ?>
                            <option value="<?= $u['id_user'] ?>"><?= $u['nama'] ?></option>                            
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group pr-3">
                    <label for="int">Rule <?php echo form_error('rule[]') ?></label>
                    <select class="form-control basic-multiple" name="rule[]" id="rule" multiple="multiple">
                        <?php foreach ($rule as $r): ?>
                            <option value="<?= $r['id_rule'] ?>"><?= $r['nama_rule'] ?></option>                            
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary"><?= $button ?></button> 
                <a href="<?php echo site_url('akses') ?>" class="btn btn-default">Cancel</a>
            </form>
          </div>
        </div>
    <?php 
        $this->load->view('templates/footer_hc');
    ?>
    <script>
        $(document).ready(function() {
            $('.basic-multiple').select2({
                theme: "classic"
            });
        });
    </script>
    </body>
</html>