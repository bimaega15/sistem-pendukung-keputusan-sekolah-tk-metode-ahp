<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableSiswa" style="width: 100%;">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkboxall">
                                <label class="form-check-label" for="checkboxall">
                                </label>
                            </div>
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Alamat
                        </th>
                        <th>
                            Jenis Kelamin
                        </th>
                        <th>
                            Nomor HP
                        </th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa-solid fa-x"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary" id="btn-submit">
            <i class="fa-regular fa-paper-plane"></i> Submit
        </button>
    </div>
</form>
<script class="kelas_id" data-value="<?= $data['kelas_id'] ?>"></script>
<script src="<?= BASEURL ?>/public/js/app/kelasSiswa/form.js"></script>