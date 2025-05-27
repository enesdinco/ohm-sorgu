<?php
include "inc/sidebar.php";
include "inc/header.php";


function getnamecolorr($rol) {
    switch ($rol) {
        case 1:
            $color = "#66FF66";
            break;
        case 2:
            $color = "#FF8000";
            break;
        case 3:
            $color = "#00FFFF";
            break;
        default:
            $color = "white";
            break;
    }
    return $color;
}

function getarkaplancolor($rol) {
    switch ($rol) {
        case 1:
            $background = "https://xenforo.gen.tr/attachments/fire_green-gif.11061/";
            break;
        case 2:
            $background = "https://xenforo.gen.tr/attachments/fire_orange-gif.11057/";
            break;
        case 3:
            $background = "https://xenforo.gen.tr/attachments/fire_blue-gif.11059/";
            break;
        default:
            $background = "";
            break;
    }
    return $background;
}

?>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                </div>
            </div>
            <!-- end page title -->

            <div class="w-100 user-chat">
                                <div class="card">
                                    <div class="p-4 border-bottom ">
                                        <div class="row">
                                            <div class="col-md-4 col-9">
                                                <h5 class="font-size-15 mb-1">Sancak Sohbet</h5>
                                                <p class="text-muted mb-0"> Küfür,Reklam yasak</p>
                                            </div>
                                            <div class="col-md-8 col-3">
                                                
                                            </div>
                                        </div>
                                    </div>
    
    
                                    <div>
                                        <div class="chat-conversation p-3">
                                            <ul class="list-unstyled mb-0" data-simplebar style="height: 330px;">
                                                        <div id="message-container">
                                                            </div>

                                                            <script>
                                                            function getMessages() {
                                                                $.ajax({
                                                                    url: '/sayfalar/cgetmessage.php',
                                                                    method: 'POST',
                                                                    headers: {
                                                                        'Content-Type': 'application/x-www-form-urlencoded',
                                                                    },
                                                                    dataType: 'json',
                                                                    success: function(data) {
                                                                        var messageContainer = $('#message-container');
                                                                        messageContainer.empty();

                                                                        $.each(data, function(index, message) {
                                                                            var liClass = (message.username === "<?= $username ?>") ? 'class="right"' : '';
                                                                            var userLink = (message.username !== "<?= $username ?>") ? 'href="/user?username=' + message.username + '"' : '';

                                                                            var newMessage = $('<li ' + liClass + '>' +
                                                                                '<div class="conversation-list">' +
                                                                                    '<div class="ctext-wrap">' +
                                                                                        '<div class="conversation-name"><a ' + userLink + '>' + message.username + '</a></div>' +
                                                                                        '<p>' + message.text + '</p>' +
                                                                                        
                                                                                        '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> ' + message.tarih + '</p>' +
                                                                                    
                                                                                        '</div>' +
                                                                                    
                                                                                '</div>' +
                                                                            '</li>');

                                                                            messageContainer.append(newMessage);
                                                                        });
                                                                    },
                                                                });
                                                            }

                                                            setInterval(getMessages, 500);
                                                        </script>


                                                        
                                                    </div>
                                                </li>
    
                                                
                                                
                                                
                                            </ul>
                                        </div>
                                        <form id="sendmessageForm">
                                        <div class="p-3 chat-input-section">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="position-relative">
                                                        <input type="text" class="form-control chat-input" id="message" placeholder="Bir mesaj yazın...">
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" onclick="sendmessage()" class="btn btn-info btn-rounded chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Gönder</span> <i class="mdi mdi-send"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                                        </form>
                                    </div>
                                </div>
                            </div>
            

    <?php
    include "inc/footer.php";
    ?>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->

<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Saas dashboard init -->
<script src="assets/js/pages/saas-dashboard.init.js"></script>

<script src="assets/js/app.js"></script>

<script>
function sendmessage() {
    var message = $("#message").val();

    if (message === "") {
        toastr.error('Boş bırakılmaz');
    } else if (["discord", "telegram", "@", "http", "ananı", "atanı", "atatürkünü", "bacını", "oc", "aq", "ameke", "salak", "mal", "sg", "aptal", "essek", "oç", "o.c", "amk", "sik", "oruspu"].some(keyword => message.includes(keyword))) {
        toastr.error('Özel karakterler ve url ve küfür yasak!');
    } else {
        $("#message").val('');

        fetch('/sayfalar/ceklemessage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'username=<?= $username ?>&date=<?= date("d.m.Y H:i") ?>&text=' + encodeURIComponent(message),
        })
        .then(response => {
            if (response.ok) {
                toastr.success("Mesajınız gönderildi!");
            } else {
                throw new Error("Mesaj gönderilemedi!");
            }
        })
    }
}
</script>




</body>

</html>