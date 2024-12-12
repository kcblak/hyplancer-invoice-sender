<?php
/*
Plugin Name: Hyplancer Invoice Sender
Plugin URI: http://hyplancer.com
Description: A plugin to send invoices to users from a CSV file
Version: 1.0
Author: James-Hart Kingsley
Author URI: https://www.linkedin.com/in/kingsley-james-hart-93679b184/
*/

// Hook to add admin page
add_action('admin_menu', 'hyplancer_invoice_sender_menu');

// Add the menu item in the WordPress Admin
function hyplancer_invoice_sender_menu() {
    add_menu_page('Hyplancer Invoice Sender', 'Hyplancer Invoice Sender', 'manage_options', 'hyplancer-invoice-sender', 'hyplancer_invoice_sender_page', 'dashicons-email');
}

// Display the plugin page
function hyplancer_invoice_sender_page() {
    ?>
    <div class="wrap">
        <h1>Send Invoices to Hyplancer Users</h1>
        <form method="POST" enctype="multipart/form-data">
            <label for="csv_file">Upload CSV File:</label>
            <input type="file" name="csv_file" accept=".csv" required>
            <input type="submit" name="submit_csv" value="Send Invoices" class="button button-primary">
        </form>

        <?php
        if (isset($_POST['submit_csv']) && isset($_FILES['csv_file'])) {
            // Process the CSV file
            process_csv_and_send_emails($_FILES['csv_file']);
        }
        ?>
    </div>
    <?php
}

// Process the uploaded CSV and send emails
function process_csv_and_send_emails($file) {
    if (($handle = fopen($file['tmp_name'], 'r')) !== FALSE) {
        // Skip the header row
        fgetcsv($handle);
        
        // Loop through the CSV rows
        while (($row = fgetcsv($handle)) !== FALSE) {
            // Extract values from the row
            $account_name = $row[0];  // Assuming 'Account Name' is the first column
            $transaction_amount = $row[1];  // 'Transaction Amount' column
            $currency = $row[2];  // 'Currency' column
            $transaction_narration = $row[3];  // 'Transaction Narration' column
            $sender_email = $row[4];  // 'Sender Email' column
            $commission = $row[5];  // 'HYplancer Commission' column
            
            // Send email to the sender
            send_invoice_email($sender_email, $account_name, $commission);
        }
        fclose($handle);
        echo '<div class="updated"><p>Invoices sent successfully!</p></div>';
    } else {
        echo '<div class="error"><p>Failed to open CSV file.</p></div>';
    }
}

// Function to send the invoice email
function send_invoice_email($sender_email, $account_name, $commission_amount) {
    $subject = 'Your Hyplancer Invoice for This Month';
    $body = "Hi, $account_name,\n\nHere is your invoice for this month:\n\n";
    $body .= "Amount to be Paid: $commission_amount USD\n";
    $body .= "Payment Method: Binance Pay\n";
    $body .= "Binance Email: dinotech123@gmail.com\n";
    $body .= "Deadline before account termination: 7 days.\n\nThank you for your business!";
    
    $headers = array(
        'From' => 'support@hyplancer.com',
        'Content-Type' => 'text/plain; charset=UTF-8',
    );
    
    // Send the email
    wp_mail($sender_email, $subject, $body, $headers);
}
?>
