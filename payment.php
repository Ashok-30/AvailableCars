<?php
include 'templates/driverdashboardheader.php';
session_start();

$add_id = $_GET['add_id'];
$user_id = $_GET['user_id'];

$_SESSION['pending_add_id'] = $add_id;
$_SESSION['pending_user_id'] = $user_id;

?>


<body class="login-page">


    <div data-aos="fade-right" data-aos-easing="linear" data-aos-duration="1000">
        <div class="container-login">
            <h1 class="login-header">
                <div>Advance payment of &pound;10.00 is required to confirm Booking</div>
             
            </h1>
            <div class="d-grid">
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>

    <script>
        AOS.init();
    </script>

    <script src="https://www.paypal.com/sdk/js?client-id=???"></script>


    <script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '10.00'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Transaction completed by ' + details.payer.name.given_name);
                var pending_add_id = "<?php echo $_SESSION['pending_add_id']; ?>";
                var pending_user_id = "<?php echo $_SESSION['pending_user_id']; ?>";
                window.location.href = "bookings.php?add_id=" + pending_add_id+"&user_id=" + pending_user_id;
            });
        }
    }).render('#paypal-button-container');
</script>
