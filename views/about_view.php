<?php
// views/about_view.php
// Renders the About Us page UI — called by about.php
class AboutView {

    public function render(): void {
        ?>
        <nav class="navbar">
            <a href="homepage.php">Home</a>
            <a href="contact.php">Contact Us</a>
            <a href="donation_form.php">Donations</a>
            <a href="volunteering_form.php">Volunteering</a>
            <a href="management.php">Management</a>
        </nav>

        <div class="container">
            <h1 class="page-title">About Us 🌾</h1>

            <div class="card about-content">
                <h2 class="about-subtitle">Smart, transparent and efficient platform</h2>
                <p class="about-text">
                Nutrioza is a comprehensive food distribution management system dedicated to reducing
                food waste and fighting hunger. We connect food suppliers with those in need through
                efficient inventory tracking, distribution management, and community engagement.
                </p>

                <div class="stats-container">
                    <div class="stat-card">
                        <h3>Number Of Transactions</h3>
                        <p class="stat-number">26,000</p>
                    </div>
                    <div class="stat-card">
                        <h3>Established Year</h3>
                        <p class="stat-number">2026</p>
                    </div>
                    <div class="stat-card">
                        <h3>Number Of Users</h3>
                        <p class="stat-number">2,600</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>