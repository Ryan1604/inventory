<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?php echo base_url(); ?>">KPP Pratama Cirebon Dua</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?php echo base_url(); ?>">KPP</a>
		</div>
		<?php if ($this->session->userdata('role') === '1') {  ?>
			<ul class="sidebar-menu">
				<li class="menu-header">Dashboard</li>
				<li class="<?= $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('superadmin/dashboard') ?>">
						<i class="fas fa-fire"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="menu-header">Data Master</li>
				<li class="<?= $this->uri->segment(2) == 'barang'  ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('superadmin/barang') ?>">
						<i class="fas fa-file"></i>
						<span>Data Barang</span>
					</a>
				</li>
				<li class="<?= $this->uri->segment(2) == 'unit'  ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('superadmin/unit') ?>">
						<i class="fas fa-list-alt"></i>
						<span>Data Inventaris Unit</span>
					</a>
				</li>
				<li class="<?= $this->uri->segment(2) == 'kondisi'  ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('superadmin/kondisi') ?>">
						<i class="fas fa-list"></i>
						<span>Data Kondisi Barang</span>
					</a>
				</li>
				<li class="menu-header">Transaksi</li>
				<li class="<?= $this->uri->segment(2) == 'barang_masuk'  ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('superadmin/barang_masuk') ?>">
						<i class="fas fa-table"></i>
						<span>Barang Masuk</span>
					</a>
				</li>
				<li class="<?= $this->uri->segment(2) == 'barang_keluar'  ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('superadmin/barang_keluar') ?>">
						<i class="fas fa-table"></i>
						<span>Barang Keluar</span>
					</a>
				</li>
				<li class="menu-header">Setting</li>
				<li class="<?= $this->uri->segment(2) == 'fee'  ? 'active' : ''; ?>">
					<a class="nav-link" href="<?= base_url('auth/logout') ?>">
						<i class="fas fa-sign-out-alt"></i>
						<span>Logout</span>
					</a>
				</li>
			</ul>
		<?php } ?>
	</aside>
</div>