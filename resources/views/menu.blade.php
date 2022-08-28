
<li><a href="/"><i class="fa fa-home"></i> <span>Beranda</span></a><li>
  <div class="container"></div>
  @if (Auth::check())
    <li><a href="admin"><i class="fa fa-user"></i> <span>Admin</span></a><li>
      <div class="container"></div>
      <li><a  href="penyakit"><i class="fa fa-bug"></i> <span>Penyakit</span></a><li>
        <div class="container"></div>
    <li><a  href="gejala"><i class="fa fa-eyedropper"></i> <span>Gejala</span></a><li>
      <div class="container"></div>
    <li><a  href="pengetahuan"><i class="fa fa-flask"></i> <span>Pengetahuan</span></a><li>
      <div class="container"></div>
    <li><a  href="post"><i class="fa fa-file-text"></i> <span>Post Keterangan</span></a><li>
      <div class="container"></div>
    <li><a  href="password"><i class="fa fa-edit"></i> <span>Ubah Password</span></a><li>
      <div class="container"></div>
      @else
      {{-- use user for user --}}
    <li><a href="diagnosa"><i class="fa fa-search-plus"></i> <span>Diagnosa</span></a><li>
      <div class="container"></div>
<li><a  href="riwayat"><i class="fa fa-clock-o"></i> <span>Riwayat</span></a><li>
      <div class="container"></div>
    <li><a  href="keterangan-user"><i class="fa fa-commenting-o"></i> <span>Keterangan</span></a><li>
      <div class="container"></div>
      @endif
<li><a  href="about"><i class="fa fa-info-circle"></i> <span>Tentang</span></a><li>
  <div class="container"></div>
