<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Admin Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span>Admin/Shares on sale</span> <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
<h5 class="text-center pb-2">Approve New Share Capital on sale</h5>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="notificationTable" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Member Number </th>
                                <th> Shares </th>
                                <th> Share Value </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


<!--    modal content-->
    <div class="modal fade" id="notificationsModalReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Shares</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        <div style="border: 1px solid black; border-radius: 5px; padding: 10px;">
                            <table style="border-collapse: collapse; width: 100%;">
                                <tr>
                                    <th style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;"></th>
                                    <th style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;"></th>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Seller's Name</td>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="notification-seller-name"></td>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Member Number</td>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="buyer-member-number"></td>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Shares</td>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="notification-shares"></td>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Sacco</td>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="notification-sacco"></td>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Shares Value (Ksh)</td>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="notification-share-value"></td>
                                </tr>
                                <tr>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;">Date Posted</td>
                                    <td style=" text-align: left; padding: 8px;   border-bottom: 1px solid #ddd;" id="notification-date"></td>
                                </tr>
                            </table>
                        </div>
                      <form method="post" action="">
                        <div class="d-flex pt-3" id="display-reject-notification">
                            <textarea class="form-control" id="reason" rows="1" placeholder="Reject with a reason*" style="border: 1px solid black; border-radius: 5px;"></textarea>
                        </div>
                          <span class="pt-2 reject-share-errors"><i class="mdi mdi-alert-circle"></i> Please enter reason for rejecting this share</span>
                        <div class="d-flex justify-content-between pt-2">
                            <button type="button" class="btn btn-warning" id="notification-reject">Reject</button>
                            <button type="button" class="btn btn-success" id="notification-approve">Approve</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
<!--    end-->

    <?= $this->include('Modules\SupperAdmin\Views\includes\footer.php'); ?>
</div>

