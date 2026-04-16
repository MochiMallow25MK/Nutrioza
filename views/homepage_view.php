<?php
// views/homepage_view.php
// Renders the homepage UI — called by homepage.php
class HomepageView {

    public function render(): void {
        ?>
        <div class="hero">
            <h1>NUTRIOZA 🌾</h1>
        </div>
        
        <nav class="navbar">
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="donation_form.php">Donations</a>
            <a href="volunteering_form.php">Volunteering</a>
            <a href="management.php">Management</a>
        </nav>

        <div class="container">
            <div class="icons-container">
                <div class="icon-item">
                    <span style="font-size:2.5rem;">🥕</span>
                    <span>Food Collection</span>
                </div>
                <span class="arrow">→</span>
                <div class="icon-item">
                    <span style="font-size:2.5rem;">🏬</span>
                    <span>Inventory Storage</span>
                </div>
                <span class="arrow">→</span>
                <div class="icon-item">
                    <span style="font-size:2.5rem;">🚚</span>
                    <span>Distribution</span>
                </div>
                <span class="arrow">→</span>
                <div class="icon-item">
                    <span style="font-size:2.5rem;">🤝</span>
                    <span>Community Impact</span>
                </div>
            </div>
        </div>
        <?php
    }
}
?>