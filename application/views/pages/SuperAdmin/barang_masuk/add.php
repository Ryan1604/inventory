<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add Data</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Data</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" class="needs-validation" action="<?php echo site_url('superadmin/barang_masuk/store') ?>" novalidate="">
                                <div class="form-group">
                                    <label>Pilih Barang</label>
                                    <select class="form-control selectric" id="barang" name="barang">
                                        <option value="" selected disabled>-- Choose Items --</option>
                                        <?php
                                        foreach ($barang as $data) : ?>
                                            <option value="<?= $data->id_barang ?>"><?= $data->kode_barang . ' | ' . $data->nama_barang ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input id="jumlah" type="number" class="form-control" value="0" name="jumlah" tabindex="1" required>
                                    <div class="invalid-feedback">
                                        Masukkan jumlah barang dalam kondisi baik terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date">Tanggal</label>
                                    <input id="date" type="date" name="date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Add Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>