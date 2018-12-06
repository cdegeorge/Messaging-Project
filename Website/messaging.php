<?php
session_start();

if (!isset($_SESSION['acct_id'])) {
    $_SESSION['msg'] = "You must log in first.";
    header('location: index.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['acct_id']);
    header("location: index.php");
}

$db = mysqli_connect("localhost", "root", "", "lexicom");
?>

<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Metro 4 -->
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css" />

    <title>Lexicom Messaging</title>
</head>
<body class="h-100">
    <div class="h-100">
        <div data-role="navview">
            <div class="navview-pane text-center bg-white border-right bd-default">
                <div class="row border-bottom bd-default pb-2 pt-4">
                    <div class="cell suggest-box text-right pr-4" style="overflow:hidden;">
                        <input data-role="search" data-clear-button="false" />
                    </div>
                    <div class="cell-2 pr-8">
                        <a href="#">
                            <span class="mif-chat mif-2x fg-black" onclick="$('#contacts_infoBox').data('infobox').open()" title="Contacts"></span>
                        </a>
                    </div>
                </div>
                <ul class="navview-menu h-100 pb-5">
                    <li>
                        <a href="#">
                            <span class="w-100" style="height:50px;" onclick="changePartner(193920042)" ;>Friend's Name</span><!-- REPLACE PARAMETER WITH PHP THAT PASSES CONTACT ID -->
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="w-100" style="height:50px;" onclick="changePartner(755540383)" ;>Friend's Name 2</span><!-- REPLACE PARAMETER WITH PHP THAT PASSES CONTACT ID -->
                        </a>
                    </li>
                </ul>
            </div>
            <div class="navview-content h-100">
                <div class="row border-bottom bd-default text-center pb-3 pt-2">
                    <div class="cell pt-2">
                        Header
                    </div>
                    <div class="cell-2 text-right pr-3">
                        <ul class="h-menu">
                            <li>
                                <a href="#" class="dropdown-toggle">
                                    <?php echo $_SESSION['username']; ?>
                                </a>
                                <ul class="d-menu" data-role="dropdown">
                                    <li>
                                        <a href="messaging.php?logout='1'" class="fg-black">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row bg-grayWhite" style="height:78%;">
                    <div class="cell">
                        <?php
                        $acct_id = $_SESSION['acct_id'];
                        $partner_id = $_COOKIE["contact"];
                        $sql = "SELECT * FROM messages WHERE (sender_id='$acct_id' AND receiver_id='$partner_id') OR (sender_id='$partner_id' AND receiver_id='$acct_id') ORDER BY time_stamp";
                        $result = mysqli_query($db, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="row pl-5 pr-5">
                            <?php if($row["sender_id"] == $acct_id) {?>
                            <div class="cell p-1 text-right">
                                <button class="button primary rounded disabled">
                                    <?php echo $row["content"]; ?>
                                </button>
                                <?php } else {?>
                                <div class="cell p-1">
                                    <button class="button secondary rounded disabled">
                                        <?php echo $row["content"]; ?>
                                    </button>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                            }
                        }
                            ?>
                            <!--
                        <div class="row pl-5 pr-5">
                            <div class="cell p-1">
                                <button class="button secondary rounded disabled">Message</button>
                            </div>
                        </div>
                        <div class="row pl-5 pr-5">
                            <div class="cell p-1 text-right">
                                <button class="button primary rounded disabled">Message</button>
                            </div>
                        </div>
					-->
                        </div>
                    </div>
                    <div class="row w-100 pb-1 pt-1 pl-3 border-top bd-default bg-white">
                        <div class="cell">
                            <form method="post" action="" id="send_message">
                                <textarea name="message_text" form="send_message" class="c-pointer" data-role="textarea" data-append="<button type='submit' class='button light' name='submit'>Send</button>" data-max-height=" 200" placeholder="Type a message"></textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contacts Window -->
    <div class="info-box" id="contacts_infoBox" data-role="infobox">
        <span class="button square closer"></span>
        <div class="info-box-content">
            <div class="text-center border-bottom bd-black pt-2 pb-2">Contacts</div>
            <div style="max-height:500px; overflow-y:scroll">
                <input type="text" id="contact_add" placeholder="Add a contact" />
                <div class="c-pointer border-bottom bd-default">Contact 1</div>
                <div class="c-pointer border-bottom bd-default">Contact 2</div>
                <div class="c-pointer border-bottom bd-default">Contact 3</div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
	$message = htmlspecialchars($_POST['message_text']);
	$content = mysqli_real_escape_string($db, $message);

	$query = "INSERT INTO messages (sender_id, receiver_id, time_stamp, content) VALUES ('$acct_id', '$partner_id', CURRENT_TIMESTAMP, '$content')";
	mysqli_query($db, $query);
	//header("Refresh:0");
}
?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
<script>

    function changePartner(contact_id) {
        var name = "contact";
        document.cookie = escape(name) + "=" + escape(contact_id);
        location.reload();
    };

    var input = document.getElementById("contact_add");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            var contact_name = input.value;
            document.cookie = escape("contact_name") + "=" + escape(contact_name);
            console.log("Submit");
        }
    });

</script>