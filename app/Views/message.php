<?= $this->extend("client_base/base.php");?>
<?= $this->section('content');?>

<?= $this->include('includes/navbar.php'); ?>

<div class="container mt-4" id="messages-container">
    <div class="row">
        <div class="col-md-4" id="column-md-4">
            <div class="messages-header">
                <h6>My messages</h6>
                <hr>
            </div>

            <div class="message-info">
                
                <div class="message-user-info">
                    <div class="avatar">
                        <span><i class="fa-solid fa-user-tie" id="avatar-icon"></i></span>
                    </div>
                    <div class="user-avar-info">
                        <a href="" class="message-info-link">
                        <div class="user-heading-container">
                            <h6>Catherine Catherine</h6>
                            <p>Hisa sacco</p>
                        </div>
                        </a>
                        <div>
                            <button type="button" class="btn-close-icon"><i class="fa-solid fa-x"></i></button>
                        </div>
                    </div>
                    <hr>
                </div> 
            </div>

            
            <div class="message-info">
                <div class="message-user-info">
                    <div class="avatar">
                        <span><i class="fa-solid fa-user-tie" id="avatar-icon"></i></span>
                    </div>
                    <div class="user-avar-info">
                        <a href="" class="message-info-link">
                        <div class="user-heading-container">
                            <h6>Catherine Waithera</h6>
                            <p>Boresha sacco</p>
                        </div>
                        </a>
                        <div>
                            <button type="button" class="btn-close-icon"><i class="fa-solid fa-x"></i></button>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            

        </div>
        <div class="col-md-8" id="column-md-8">
            <div class="messages-content-section">
                <div class="users-chatting">

                </div>
                <div>
                <div class="messages-input-fields"> 
                    <div class="s">
                        
                        <textarea placeholder="Type your message here" class="text-area-input"></textarea>
                        <button type="submit" class="single-message-submit-button"><i class="fa-solid fa-paper-plane messages-input-field-icon"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

