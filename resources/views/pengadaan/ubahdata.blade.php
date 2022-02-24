<!-- Modal -->
<div class="modal fade" id="ubahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengadaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/ubahData" method="post" role="form" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id_pengadaan"  id="id_pengadaan" class="id_pengadaan">
        <div class="modal-body">
          <div class="card-body">
          <div class="form-group">
              <label for="exampleInputEmail1">Nama Pengadaan</label>
              <input type="text" class="form-control nama_pengadaan" id="u_nama_pengadaan" name="u_nama_pengadaan" placeholder="isi pengadaan">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Deskripsi </label>
              <textarea type="text" class="form-control deskripsi" id="u_deskripsi" name="u_deskripsi" placeholder="Isi Deskripsi Pengadaan"></textarea>
            </div>
            <div class="form-group">
              <label>Anggaran: <input type="" class="labelRp" disable style =" border:none; background-color: white; color: black;"></label>
              <input type="text" class="form-control anggaran" id="u_anggaran" name="u_anggaran" placeholder="anggaran" onkeyup="currency2()">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Data</button>
        </div>
      </form>
    </div>
  </div>
</div>