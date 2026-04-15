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
                    The global food industry is evolving from a fragmented, manual, and wasteful state
                    to a data-driven, streamlined, and sustainable one. We believe that with the rise
                    of integrated logistics and real-time inventory management, a new era of food security
                    is taking place, and we aim to play a fundamental and key role in this transformation.
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