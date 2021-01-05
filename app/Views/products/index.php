<div class="row form-group justify-content-center d-flex mt-5" id="sectionProducts">
    <div class="col-12">
        <h2>List of Products</h2>
        <hr>
    </div>

    <div class="col-12 mt-4">
        <div class="modal fade in" id="modalProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-purple">
                        <h5 class="modal-title text-white">New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class='form-group'>
                                    <label for='description'>Description: </label>
                                    <input type='text' class='form-control' id='description'>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class='form-group'>
                                    <label for='price'>Price: </label>
                                    <input type='text' class='form-control currency' id='price' value="0" placeholder="0,00">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class='form-group'>
                                    <label for='productType'>Product Type: </label>
                                    <select class="form-control" id="productType" style="width: 100%;">
                                        <option selected value=""><-- SELECT --></option>

                                        <?php foreach ($productsType as $type): ?>
                                        <option value="<?=$type->id?>"><?=\mb_strtoupper($type->description)?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="id" value="">

                    <div class="modal-footer text-xs-center" style="background-color:#f5f5f5;">
                        <button type="button" class="btn btn-purple" id="saveProduct">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-purple" type="button" id="addProduct"> <i class="fa fa-plus"></i> Add Product</button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm" id="tableProducts" style="width: 100% !important">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Product Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>