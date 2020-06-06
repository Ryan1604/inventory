<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Data</h4>
                        </div>
                        <div class="card-body">
                            <?php foreach ($barang as $data) : ?>
                                <form method="post" class="needs-validation" action="<?php echo site_url('superadmin/barang/update') ?>" novalidate="">
                                    <div class="form-group">
                                        <label for="kode">Kode Barang</label>
                                        <input id="kode" type="text" class="form-control" name="kode" value="<?= $data->kode_barang ?>" tabindex="1" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama Barang</label>
                                        <input type="hidden" name="id" value="<?= $data->id_barang ?>">
                                        <input id="name" type="text" class="form-control" name="name" value="<?= $data->nama_barang ?>" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Masukkan nama barang terlebih dahulu
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Unit</label>
                                        <select class="form-control selectric" id="category" name="category">
                                            <option value="" selected disabled>-- Choose Category --</option>
                                            <?php
                                            foreach ($category as $d) : ?>
                                                <option <?php if ($data->id_category == $d->id_category) : echo 'selected'; ?><?php endif; ?> value=<?= $d->id_category ?>> <?= $d->name_category ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="baik">Kondisi Baik</label>
                                        <input id="baik" type="number" class="form-control" value="<?= $data->baik ?>" name="baik" tabindex="1" required>
                                        <div class="invalid-feedback">
                                            Masukkan jumlah barang dalam kondisi baik terlebih dahulu
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak">Kondisi Rusak</label>
                                        <input id="rusak" type="number" class="form-control" value="<?= $data->rusak ?>" name="rusak" tabindex="1" required>
                                        <div class="invalid-feedback">
                                            Masukkan jumlah barang dalam kondisi baik terlebih dahulu
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Edit Data
                                        </button>
                                    </div>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>