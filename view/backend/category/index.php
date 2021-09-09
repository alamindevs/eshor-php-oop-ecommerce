<?php partials_view( "backend/partials/_header" )?>
<div class="card">
    <div class="card-body">
        <form action="/dashboard/category" method="POST">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name='name' id="name" placeholder="CategoryName" />
                <?php if ( !empty( $_SESSION['errors']['name'] ) ) {?>
                    <span style="color:red;"><?=$_SESSION['errors']['name']?></span>
                <?php }
                    unset( $_SESSION['errors'] );
                ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                  <input type="checkbox" class="form-check-input" name='status' id="exampleCheck1" style="border: 1px solid #000;">
                  <label class="form-check-label"  for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class='btn btn-success'>Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row py-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Category Table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7 text-end">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $categorys = App\Models\Category::get();
                  ?>
<?php
    foreach ( $categorys as $category ):
?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?=$category->name?></h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <?=$category->statusButton()?>
                      </td>
                      <td class="text-end">
                        <a href="javascript:;" class="btn btn-success btn-sm " data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                        <a href="javascript:;" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Edit user">
                          Delete
                        </a>
                      </td>
                    </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php partials_view( "backend/partials/_footer" )?>