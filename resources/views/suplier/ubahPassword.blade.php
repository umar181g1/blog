<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="/ubahPassword" method="post" role="form">
        {{csrf_field()}}
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputPassword1">Password Lama</label>
              <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password Baru</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </form>
    </div>
  </div>
</div>