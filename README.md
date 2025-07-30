# DR-Coffee ☕

![DRCoffee Logo](./user/Images/DRCoffee_Logo.png)

A full-featured e-commerce web application for a coffee shop. This project is built with pure PHP, HTML, CSS, and JavaScript, providing a complete online shopping experience from product browsing to order fulfillment.

## ✨ Features

*   **Customer-Facing:**
    *   **User Authentication:** Secure user registration and login system.
    *   **Product Catalog:** Browse and view a variety of coffee products.
    *   **Product Search:** Easily find products with a search bar.
    *   **Shopping Cart:** Add/remove items and view the cart.
    *   **Checkout Process:** Place orders and receive confirmation.
    *   **Order History:** View past orders and generate invoices (`facture.php`).
    *   **Contact Form:** Send inquiries directly to the administration via a functional contact form (`mail.php`).
*   **Admin Panel (`/admin`):**
    *   **Dashboard:** A central panel to manage the store.
    *   **Order Management:** View and process incoming customer orders.
    *   **Product Management:** (Assumed) Add, update, or remove products.

## 🛠️ Tech Stack

*   **Backend:** PHP
*   **Database:** MySQL (Inferred from `connectDB.php`)
*   **Frontend:** HTML, CSS, JavaScript
*   **Mail Service:** [PHPMailer](https://github.com/PHPMailer/PHPMailer) for sending emails.
*   **Dependency Management:** [Composer](https://getcomposer.org/)

## 🚀 Getting Started

Follow these instructions to get the project up and running on your local machine.

### Prerequisites

*   A local web server environment (e.g., XAMPP, WAMP, MAMP).
*   [Composer](https://getcomposer.org/) installed.
*   A MySQL database server.

### Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/NoureddineDRIOUECH/DRCoofee---Coffee-Srore.git
    cd DRCoffee
    ```

2.  **Install PHP dependencies:**
    This project uses Composer to manage libraries like PHPMailer.
    ```bash
    composer install
    ```

3.  **Database Setup:**
    *   Using a tool like phpMyAdmin, create a new database for the project.
    *   You will need to import the database schema. If you have a `.sql` file, import it. If not, you may need to create one from your development environment.
    *   Configure the database connection by editing `connectDB.php` with your credentials:
      ```php
      <?php
      $servername = "localhost";
      $username = "your_db_username";
      $password = "your_db_password";
      $dbname = "your_db_name";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      ?>
      ```

4.  **Run the Application:**
    *   Place the entire `DRCoffee` project folder into your web server's root directory (e.g., `htdocs/` for XAMPP).
    *   Open your web browser and navigate to `http://localhost/DRCoffee/`.

## 📂 Folder Structure

```
/
├── admin/          # Contains all files for the admin panel
├── Images/         # Contains global image assets
├── mailer/         # Contains the PHPMailer library and autoloader
├── user/           # Contains user-specific pages (profile, orders, etc.)
├── *.php           # Core public-facing pages (home, products, login)
├── *.css           # Stylesheets for corresponding pages
├── *.js            # JavaScript for corresponding pages
├── composer.json   # Defines PHP project dependencies
└── README.md       # This file
```

---
