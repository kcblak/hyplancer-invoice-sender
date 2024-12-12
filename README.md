# Hyplancer Invoice Sender

**Plugin Name:** Hyplancer Invoice Sender  
**Plugin URI:** http://hyplancer.com  
**Description:** A plugin to send invoices to users from a CSV file  
**Version:** 1.0  
**Author:** James-Hart Kingsley  
**Author URI:** [LinkedIn](https://www.linkedin.com/in/kingsley-james-hart-93679b184/)

## Description

The Hyplancer Invoice Sender plugin allows you to send invoices to users listed in a CSV file. This plugin is perfect for automating the process of sending monthly invoices to your users.

## Features

- Upload a CSV file to send invoices
- Automatically processes the CSV and sends emails to users
- Customizable email content

## Installation

1. Download the plugin ZIP file or clone the repository.
2. Upload the plugin files to your WordPress site in the `/wp-content/plugins/hyplancer-invoice-sender` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

1. Go to the Hyplancer Invoice Sender page in the WordPress admin menu.
2. Upload a CSV file containing the invoice data.
3. Click the "Send Invoices" button to send emails to users.

### CSV File Format

The CSV file should have the following columns:

1. **Account Name** - The name of the user.
2. **Transaction Amount** - The amount of the transaction.
3. **Currency** - The currency of the transaction.
4. **Transaction Narration** - A description of the transaction.
5. **Sender Email** - The email address of the user.
6. **Hyplancer Commission** - The commission amount for Hyplancer.

### Example CSV File

```csv
Account Name,Transaction Amount,Currency,Transaction Narration,Sender Email,Hyplancer Commission
John Doe,100,USD,Service Fee,john.doe@example.com,10
Jane Smith,200,USD,Product Purchase,jane.smith@example.com,20
