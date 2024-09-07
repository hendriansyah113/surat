<style>
	.sidebar-item.active .sidebar-link {
		background-color: #007bff;
		color: white;
	}
</style>
<?php
// Ambil hak akses pengguna dari sesi
$user_role = $this->session->userdata('level');
?>

<nav class="sidebar" id="sidebar">
	<div class="logo-sidebar mb-3">
		<a href="<?= site_url('dashboard') ?>" class="sidebar-brand text-white">
			<span>Layanan Surat Desa</span>
		</a>
	</div>
	<div class="content-menu-sidebar">
		<ul class="sidebar-nav">
			<li class="sidebar-item <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
				<a href="<?= site_url('dashboard') ?>" class="sidebar-link">
					<i class="fa fa-cogs" aria-hidden="true"></i>
					<span class="align-middle">Dashbord</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- Data Master -->
	<?php if ($user_role == 'capil' || $user_role == 'admin'): ?>
		<div class="content-menu-sidebar">
			<ul class="sidebar-nav">
				<li class="sidebar-header">Data Master</li>
				<li class="sidebar-item <?= ($this->uri->segment(1) == 'penduduk') ? 'active' : '' ?>">
					<a href="<?= site_url('penduduk') ?>" class="sidebar-link">
						<i class="fa fa-user-circle" aria-hidden="true"></i>
						<span class="align-middle">Data Penduduk</span>
					</a>
				</li>
				<li class="sidebar-item <?= ($this->uri->segment(1) == 'kartu_keluarga') ? 'active' : '' ?>">
					<a href="<?= site_url('kartu_keluarga') ?>" class="sidebar-link">
						<i class="fa fa-id-card" aria-hidden="true"></i>
						<span class="align-middle">Data Kartu Keluarga</span>
					</a>
				</li>
				<li class="sidebar-item <?= ($this->uri->segment(1) == 'akta_kelahiran') ? 'active' : '' ?>">
					<a href="<?= site_url('akta_kelahiran') ?>" class="sidebar-link">
						<i class="fa fa-file" aria-hidden="true"></i>
						<span class="align-middle">Data Akta Kelahiran</span>
					</a>
				</li>
			</ul>
		</div>
	<?php endif; ?>

	<!-- Menu Petugas -->
	<?php if ($user_role == 'petugas' || $user_role == 'capil'): ?>
		<div class="content-menu-sidebar">
			<ul class="sidebar-nav">
				<li class="sidebar-header">Menu Petugas</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'surat_tugas' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
					<a href="<?= site_url('surat_tugas') ?>" class="sidebar-link">
						<i class="fa fa-briefcase" aria-hidden="true"></i>
						<span class="align-middle">Surat Tugas</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_usaha' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_usaha') ?>" class="sidebar-link">
						<i class="fa fa-building" aria-hidden="true"></i>
						<span class="align-middle">SK Usaha</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_nikah' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_nikah') ?>" class="sidebar-link">
						<i class="fa fa-heart" aria-hidden="true"></i>
						<span class="align-middle">SK Nikah</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_domisili' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_domisili') ?>" class="sidebar-link">
						<i class="fa fa-home" aria-hidden="true"></i>
						<span class="align-middle">SK Domisili</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_penghasilan' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_penghasilan') ?>" class="sidebar-link">
						<i class="fa fa-money" aria-hidden="true"></i>
						<span class="align-middle">SK Penghasilan</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_tidak_mampu' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_tidak_mampu') ?>" class="sidebar-link">
						<i class="fa fa-user-times" aria-hidden="true"></i>
						<span class="align-middle">SK Tidak Mampu</span>
					</a>
				</li>
			</ul>
		</div>
	<?php endif; ?>

	<!-- Menu Admin -->
	<?php if ($user_role == 'admin'): ?>
		<div class="content-menu-sidebar">
			<ul class="sidebar-nav">
				<li class="sidebar-header">Menu Admin</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'surat_tugas' && $this->uri->segment(2) == 'admin_list') ? 'active' : '' ?>">
					<a href="<?= site_url('surat_tugas/admin_list') ?>" class="sidebar-link">
						<i class="fa fa-briefcase" aria-hidden="true"></i>
						<span class="align-middle">Surat Tugas</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_usaha' && $this->uri->segment(2) == 'admin_list') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_usaha/admin_list') ?>" class="sidebar-link">
						<i class="fa fa-building" aria-hidden="true"></i>
						<span class="align-middle">SK Usaha</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_nikah' && $this->uri->segment(2) == 'admin_list') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_nikah/admin_list') ?>" class="sidebar-link">
						<i class="fa fa-heart" aria-hidden="true"></i>
						<span class="align-middle">SK Nikah</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_domisili' && $this->uri->segment(2) == 'admin_list') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_domisili/admin_list') ?>" class="sidebar-link">
						<i class="fa fa-home" aria-hidden="true"></i>
						<span class="align-middle">SK Domisili</span>
					</a>
				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_penghasilan' && $this->uri->segment(2) == 'admin_list') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_penghasilan/admin_list') ?>" class="sidebar-link">
						<i class="fa fa-money" aria-hidden="true"></i>
						<span class="align-middle">SK Penghasilan</span>
					</a>

				</li>
				<li
					class="sidebar-item <?= ($this->uri->segment(1) == 'sk_tidak_mampu' && $this->uri->segment(2) == 'admin_list') ? 'active' : '' ?>">
					<a href="<?= site_url('sk_tidak_mampu/admin_list') ?>" class="sidebar-link">
						<i class="fa fa-user-times" aria-hidden="true"></i>
						<span class="align-middle">SK Tidak Mampu</span>
					</a>
				</li>
			</ul>
		</div>
	<?php endif; ?>

</nav>