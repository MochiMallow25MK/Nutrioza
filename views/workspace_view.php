<?php
// views/workspace_view.php
// Renders the workspace shell: top navbar + 20/80 sidebar/content layout
// Called by workspace.php — passes data in, this file only handles display
class WorkspaceView {

    // Render the full page shell
    // $sidebar  — HTML string for the sidebar
    // $content  — HTML string for the main content area
    // $role     — logged-in user's role name
    // $username — logged-in username
    public function render(string $sidebar, string $content, string $role, string $username): void {
        ?>
        <!-- Top nav -->
        <nav class="navbar" style="justify-content:space-between;">
            <span style="color:var(--cream); font-size:1.1rem; letter-spacing:2px;">NUTRIOZA 🌾</span>
            <div style="display:flex; gap: 8px;">
                <a href="logout.php">Logout</a>
            </div>
        </nav>

        <div class="workspace-wrapper">
            <!-- Sidebar 20% -->
            <aside class="sidebar">
                <div class="sidebar-title">Menu</div>
                <?= $sidebar ?>
                <div class="sidebar-role">
                    👤 <?= htmlspecialchars($username) ?><br>
                    🏷 <?= htmlspecialchars($role) ?>
                </div>
            </aside>

            <!-- Main content 80% -->
            <main class="main-content">
                <?= $content ?>
            </main>
        </div>

        <script>
        function openModal(id)  { document.getElementById(id).classList.add('open'); }
        function closeModal(id) { document.getElementById(id).classList.remove('open'); }

        document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) overlay.classList.remove('open');
            });
        });

        ['createForm','editForm'].forEach(function(formId) {
            var form = document.getElementById(formId);
            if (!form) return;
            form.addEventListener('submit', function(e) {
                var empty = false;
                form.querySelectorAll('input[required]').forEach(function(input) {
                    if (!input.value.trim()) { input.classList.add('error'); empty = true; }
                    else input.classList.remove('error');
                });
                if (empty) {
                    e.preventDefault();
                    alert('Wrong input! Please fill in all required fields.');
                }
            });
        });
        </script>
        <?php
    }

    // Render sidebar links
    public function renderSidebar(array $allowedTables, string $activeTable, bool $isViewer, bool $isAuditor, string $reportTable): string {
        $html = '';
        foreach ($allowedTables as $t) {
            $label  = $this->tableLabel($t);
            $icon   = $isViewer ? '👁' : ($isAuditor ? '📄' : '⚙');
            $href   = $isAuditor
                ? "?table=$t&report=$t"
                : "?table=$t";
            $active = ($isAuditor ? $reportTable === $t : $activeTable === $t) ? 'active' : '';
            $html  .= "<a href=\"$href\" class=\"$active\">$icon $label</a>\n";
        }
        return $html;
    }

    // Pretty label helper
    public function tableLabel(string $t): string {
        return ucwords(str_replace('_', ' ', $t));
    }
}
?>