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
                            <?php foreach ($keluar as $data) : ?>
                                <form method="post" class="needs-validation" action="<?php echo site_url('superadmin/barang_keluar/update') ?>" novalidate="">
                                    <input type="hidden" name="id" value="<?= $data->id_keluar ?>">
                                    <div class="form-group">
                                        <label>Pilih Barang</label>
                                        <select class="form-control selectric" id="barang" name="barang">
                                            <option value="" selected disabled>-- Choose Items --</option>
                                            <?php
                                            foreach ($barang as $d) : ?>
                                                <option <?php if ($data->id_barang == $d->id_barang) : echo 'selected'; ?><?php endif; ?> value=<?= $d->id_barang ?>> <?= $d->kode_barang . ' | ' . $d->nama_barang ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input id="jumlah" type="number" class="form-control" value="<?= $data->jumlah ?>" name="jumlah" tabindex="1" required>
                                        <div class="invalid-feedback">
                                            Masukkan jumlah barang dalam kondisi baik terlebih dahulu
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input id="date" type="date" name="date" value="<?= $data->date ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <select class="form-control selectric" id="ket" name="ket">
                                            <option <?php if ($data->keterangan == "Rusak") : echo 'selected'; ?><?php endif; ?> value="Rusak">Rusak</option>
                                            <option <?php if ($data->keterangan == "Pembuangan") : echo 'selected'; ?><?php endif; ?> value="Pembuangan">Pembuangan Barang Rusak</option>
                                        </select>
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