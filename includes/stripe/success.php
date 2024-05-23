<?php
//if ( ! defined( 'ABSPATH' ) ) {
//    exit;
//}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo "Payment is successful"?></title>
    <?php // wp_head(); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has('session_id') && searchParams.has('plan') && searchParams.has('admin_url') && searchParams.has('nonce') && searchParams.has('price_id')) {
                const session_id = searchParams.get('session_id');
                const plan = searchParams.get('plan');
                const admin_url = searchParams.get('admin_url');
                const nonce = searchParams.get('nonce');
                const price_id = searchParams.get('price_id');

                $('#successForm').attr('action', admin_url);
                $('#plan').val(plan);
                $('#price_id').val(price_id);
                $('#nonce').val(nonce);
                $('#session-id').val(session_id);

                // Add event listener to the submit button
                $('#submitBtn').click(function(event) {
                    // Prevent default form submission
                    event.preventDefault();

                    // Submit the form
                    $('#successForm').submit();
                });
            }
        });
    </script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #242d60;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto',
            'Helvetica Neue', 'Ubuntu', sans-serif;
            height: 100vh;
            margin: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: 2px solid #007bff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
            color: #fff;
        }

        /* Card Styles */
        .card {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card h2 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card p {
            margin-bottom: 20px;
            font-size: 16px;
            line-height: 1.5;
        }

    </style>
</head>
<body>
<div class="description Box-root card">
    <h3><?php echo "Checkout successful!";?></h3>
    <p><?php echo "Click the button for your subscription completion.";?></p>
    <form method="post" id="successForm" action="">
        <input type="hidden" name="action" value="success_plan_action">
        <input type="hidden" id="session-id" name="session_id" value="" />
        <input type="hidden" id="plan" name="plan" value="" />
        <input type="hidden" id="price_id" name="price_id" value="" />
        <input type="hidden" id="nonce" name="nonce" value="" />
        <button type="submit" id="submitBtn" class="btn btn-lg btn-block btn-outline-primary"><?php echo "Submit"; ?></button>
    </form>
</div>
</body>
</html>