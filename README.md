# 🌾 Nutrioza - Food Distribution Management System

Nutrioza is a comprehensive food distribution management system designed to reduce food waste and fight hunger by connecting food suppliers with those in need through efficient inventory tracking, distribution management, and community engagement.

## Table of Contents
- [Features](#features)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Folder Structure](#folder-structure)
- [User Roles & Credentials](#user-roles--credentials)
- [Usage Guide](#usage-guide)
- [Technical Architecture](#technical-architecture)
- [API Routes](#api-routes)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

## Features

### User Management
- Role-based access control (Admin, Manager, Warehouse Staff, Supplier, Viewer, Public User)
- Secure authentication with password encryption
- User account management with status control

### Food Inventory Management
- Track food items with categories and suppliers
- Monitor stock quantities and expiry dates
- Low stock and near-expiry alerts
- Automatic inventory updates

### Supplier & Procurement
- Supplier information management
- Purchase order generation
- Incoming stock delivery tracking

### Distribution Management
- Record outgoing food distributions
- Recipient management (NGOs, Kitchens, Stores)
- Distribution approval workflow
- Printable distribution receipts

### Reporting & Monitoring
- Stock reports with filtering
- Distribution history reports
- Supplier performance reports
- Date range filtering

### Public Features
- About Us page
- Contact Us form
- Donation submission
- Volunteer application

## System Requirements

- **Web Server:** Apache 2.4+
- **PHP:** Version 7.4 or 8.0+
- **Database:** MySQL 5.7+ or MariaDB 10.4+
- **Browser:** Chrome, Firefox, Edge, Safari (latest versions)
- **XAMPP:** 8.x (recommended for local development)

## Installation

### Step 1: Install XAMPP
Download and install XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)

### Step 2: Clone the Project
```bash
# Navigate to XAMPP's htdocs folder
cd C:\xampp\htdocs\

# Clone or copy the project
# If using Git:
git clone https://github.com/yourusername/Nutrioza.git

# Or simply copy the Nutrioza folder to htdocs