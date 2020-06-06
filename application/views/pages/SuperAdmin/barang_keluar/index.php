<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Barang Keluar</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Data Barang Keluar</div>
			</div>
		</div>
		<div class="section-body">
			<a href="<?= base_url('superadmin/barang_keluar/create') ?>" class="btn btn-primary btn-s"><i class="fa fa-plus"></i> Add Data</a><br><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="example">
									<thead>
										<tr>
											<th class="text-center">
												#
											</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Jumlah</th>
											<th>Tanggal Barang Keluar</th>
											<th>Keterangan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($barang as $data) :
											$originalDate = $data->date;
											$newDate = date("d M Y", strtotime($originalDate));
										?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $data->kode_barang ?></td>
												<td><?= $data->nama_barang ?></td>
												<td><?= $data->jumlah ?></td>
												<td><?= $newDate ?></td>
												<td><?= $data->keterangan ?></td>
												<td>
													<a href="<?php echo base_url('superadmin/barang_keluar/edit/') . $data->id_keluar ?>" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
													<a href="<?php echo base_url('superadmin/barang_keluar/delete/') . $data->id_keluar ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure want to Delete ?')" title="Delete"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>