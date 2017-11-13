<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Daftar Admin</h4>
                        <hr>
                        <a class="btn btn-with-icon btn-primary btn-fill btn-wd btn-header" href="user/add"><i class="ti-user"></i>Tambah Admin</a>
                        <input type="text" placeholder="Search.." class="search-field pull-right">
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped live-table">
                            <thead>
                                <tr class="table-header">
                                    <th>Nama</th>
                                    <th>Akses Level</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($data) {
                                    foreach ($data as $key=>$result) {
                                ?>
                                <tr>
                                  <td class="col-md-5"><?php echo $result['user_fullname'];?></td>
                                  <td  class="col-md-5"><?php echo $retVal = ($result['user_access_level']==1) ?  "Root Admin" :  "Admin" ;?></td>
                                  <td class="td-buttons">
                                    <a href="#" data-href="user/delete/<?php echo $result['user_id'];?>" data-target="#confirm-delete" class="btn btn-sm btn-danger btn-fill"><i class="ti-eraser"></i>Hapus</a>
                                  </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr><td colspan="4"><p class="text-primary text-center">Tidak ada data</p></td></tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
