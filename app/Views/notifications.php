<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>
<?= $this->include('includes/navbar.php'); ?>


<div class="container pt-5 pb-5">
    <div class="row sm-gap">
        <div class="col-md-4">
            <div class="notifications-container">
                <div class="manage-notifications">
                    Manage Your share Capital Notifications
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="notifications-container">
                <div class="notification-message-container">
                    <span><i class="fa-sharp fa-solid fa-circle-dot unread-notification-icon"></i></span>
                    <p>Your Bid of Ksh 300, for Port sacco has been approved. You can now buy the share capital</p>
                </div>
                <div class="notification-action-container">
                    <span>20m</span>
                    <div class="dropdown dropstart">
                        <a
                            href="#"
                            id="dropdownMenuLink"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <span><i class="fa-solid fa-ellipsis share-badge"></i></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" id="save-share" data-id=""><i class="fa-solid fa-trash" style="padding: 4px;"></i>Delete</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bell-slash" style="padding: 4px;"></i>Mute</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="notifications-container">
                <div class="notification-message-container">
                    <span><i class="fa-sharp fa-solid fa-circle-dot unread-notification-icon"></i></span>
                    <p>Your Bid of Ksh 300, for Port sacco has been approved. You can now buy the share capital</p>
                </div>
                <div class="notification-action-container">
                    <span>20m</span>
                    <div class="dropdown dropstart">
                        <a
                            href="#"
                            id="dropdownMenuLink"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <span><i class="fa-solid fa-ellipsis share-badge"></i></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" id="save-share" data-id=""><i class="fa-regular fa-bookmark" style="padding: 4px;"></i>Save</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-regular fa-share-from-square" style="padding: 4px;"></i>Share</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="notifications-container">
                <div class="notification-message-container">
                    <span><i class="fa-sharp fa-solid fa-circle-dot unread-notification-icon"></i></span>
                    <p>Your Bid of Ksh 300, for Port sacco has been approved. You can now buy the share capital</p>
                </div>
                <div class="notification-action-container">
                    <span>20m</span>
                    <div class="dropdown dropstart">
                        <a
                            href="#"
                            id="dropdownMenuLink"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <span><i class="fa-solid fa-ellipsis share-badge"></i></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" id="save-share" data-id=""><i class="fa-regular fa-bookmark" style="padding: 4px;"></i>Save</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-regular fa-share-from-square" style="padding: 4px;"></i>Share</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="notifications-container">
                <div class="notification-message-container">
                    <span><i class="fa-sharp fa-solid fa-circle-dot unread-notification-icon"></i></span>
                    <p>Your Bid of Ksh 300, for Port sacco has been approved. You can now buy the share capital</p>
                </div>
                <div class="notification-action-container">
                    <span>20m</span>
                    <div class="dropdown dropstart">
                        <a
                            href="#"
                            id="dropdownMenuLink"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <span><i class="fa-solid fa-ellipsis share-badge"></i></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" id="save-share" data-id=""><i class="fa-regular fa-bookmark" style="padding: 4px;"></i>Save</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-regular fa-share-from-square" style="padding: 4px;"></i>Share</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


<?= $this->include('includes/footer.php'); ?>
<?= $this->include('includes/small-footer.php'); ?>

<?= $this->endSection();?>
<?php $this->section('notification-scripts');?>
<script>
    let conn = new WebSocket('ws://localhost:8000/server/index');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
    };
</script>
<?php $this->endSection();?>
