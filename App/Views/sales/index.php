<div class="row form-group justify-content-center d-flex mt-5">
    <div class="col-12">
        <h2>List of Sales</h2>
        <hr>
    </div>

    <div class="col-12 mt-4">
        <div class="modal fade in" id="modalSales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-purple">
                        <h5 class="modal-title">New Sale</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class='form-group'>
                            <label for='clientName'>Client: </label>
                            <input type='text' class='form-control' id='clientName'>
                        </div>

                        <div class='form-group'>
                            <label for='totalTax'>Total Tax: </label>
                            <input type='text' class='form-control' id='totalTax'>
                        </div>

                        <div class='form-group'>
                            <label for='totalPrice'>Total Price: </label>
                            <input type='text' class='form-control' id='totalPrice'>
                        </div>
                    </div>

                    <input type="hidden" id="id" value="">

                    <div class="modal-footer text-xs-center" style="background-color:#f5f5f5;">
                        <button type="button" class="btn btn-purple" id="saveSale">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-purple" type="button" id="addSale"> <i class="fa fa-plus"></i> Add Sale</button>
        </div>

        <table class="table table-striped table-sm" id="tableSales" style="width: 100%">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Total Tax</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>