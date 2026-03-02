document.addEventListener('DOMContentLoaded', function() {
    
    if (document.querySelector('.cards-container')) {
        const cards = document.querySelectorAll('.role-card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                const role = this.dataset.role;
                let roleName = '';
                
                switch(role) {
                    case 'admin':
                        roleName = 'Admin';
                        break;
                    case 'manager':
                        roleName = 'Manager';
                        break;
                    case 'viewer':
                        roleName = 'Viewer';
                        break;
                    case 'warehouse':
                        roleName = 'Warehouse Staff';
                        break;
                    case 'supplier':
                        roleName = 'Supplier';
                        break;
                    case 'guest':
                        roleName = 'Guest';
                        break;
                }
                
                sessionStorage.setItem('selectedRole', role);
                sessionStorage.setItem('selectedRoleName', roleName);
                window.location.href = 'login.html';
            });
        });
    }
    
    if (document.getElementById('loginForm')) {
        const role = sessionStorage.getItem('selectedRole');
        const roleName = sessionStorage.getItem('selectedRoleName') || 'Admin';
        
        document.getElementById('loginTitle').textContent = `Nutrioza ${roleName} Management 🌾`;
        document.getElementById('roleDisplay').textContent = `${roleName} Login`;
        document.getElementById('roleType').value = role;
        
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('roleType').value;
            
            const credentials = {
                admin: { user: 'NutriozaAdmin', pass: 'Admin123' },
                manager: { user: 'NutriozaManager', pass: 'Manager123' },
                viewer: { user: 'NutriozaViewer', pass: 'Viewer123' },
                warehouse: { user: 'NutriozaWarehouseStaff', pass: 'WarehouseStaff123' },
                supplier: { user: 'NutriozaSupplier', pass: 'Supplier123' },
                guest: { user: 'NutriozaUser', pass: 'User123' }
            };
            
            if (credentials[role] && username === credentials[role].user && password === credentials[role].pass) {
                sessionStorage.setItem('loggedInRole', role);
                window.location.href = 'workspace.html';
            } else {
                document.getElementById('loginError').textContent = 'Invalid username or password';
            }
        });
    }
    
    if (document.querySelector('.workspace-container')) {
        const role = sessionStorage.getItem('loggedInRole');
        const sidebar = document.getElementById('functionalitySidebar');
        const workArea = document.getElementById('workArea');
        
        const functions = {
            admin: ['Manage Users', 'Approve Volunteer', 'Approve Donation', 'Assign Roles', 'Monitor Stock Levels', 'Generate Reports'],
            manager: ['Generate Distribution Invoice', 'Approve Distribution'],
            viewer: ['View Distribution History'],
            warehouse: ['Record Distribution', 'Track Expiry Dates', 'Add Food Item', 'Update Food Item', 'Delete Food Item'],
            supplier: ['Record Incoming Stock', 'Manage Suppliers', 'Submit Donation'],
            guest: ['Submit Donation', 'Apply as Volunteer']
        };
        
        if (functions[role]) {
            const ul = document.createElement('ul');
            functions[role].forEach(func => {
                const li = document.createElement('li');
                li.textContent = func;
                li.addEventListener('click', function() {
                    handleFunctionClick(func, role);
                });
                ul.appendChild(li);
            });
            sidebar.appendChild(ul);
        }
    }
    
    if (document.getElementById('donationForm')) {
        const donationType = document.getElementById('donationType');
        const moneyOptions = document.getElementById('moneyOptions');
        const foodOptions = document.getElementById('foodOptions');
        
        donationType.addEventListener('change', function() {
            if (this.value === 'money') {
                moneyOptions.style.display = 'block';
                foodOptions.style.display = 'none';
            } else if (this.value === 'food') {
                moneyOptions.style.display = 'none';
                foodOptions.style.display = 'block';
            } else {
                moneyOptions.style.display = 'none';
                foodOptions.style.display = 'none';
            }
        });
        
        document.getElementById('donationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value.trim();
            const age = document.getElementById('age').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            
            if (name.length < 2) {
                alert('Please enter a valid name');
                return;
            }
            
            if (age < 1 || age > 120) {
                alert('Please enter a valid age');
                return;
            }
            
            if (!email.includes('@') || !email.includes('.')) {
                alert('Please enter a valid email address');
                return;
            }
            
            if (!/^\d{10,15}$/.test(phone)) {
                alert('Please enter a valid phone number (10-15 digits)');
                return;
            }
            
            alert('The donation has been submitted successfully !');
            this.reset();
            moneyOptions.style.display = 'none';
            foodOptions.style.display = 'none';
        });
    }
    
    if (document.getElementById('volunteeringForm')) {
        document.getElementById('volunteeringForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value.trim();
            const age = document.getElementById('age').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            
            if (name.length < 2) {
                alert('Please enter a valid name');
                return;
            }
            
            if (age < 1 || age > 120) {
                alert('Please enter a valid age');
                return;
            }
            
            if (!email.includes('@') || !email.includes('.')) {
                alert('Please enter a valid email address');
                return;
            }
            
            if (!/^\d{10,15}$/.test(phone)) {
                alert('Please enter a valid phone number (10-15 digits)');
                return;
            }
            
            alert('Your volunteer application has been submitted successfully !');
            this.reset();
        });
    }
    
    if (document.getElementById('contactForm')) {
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const name = document.getElementById('name').value.trim();
            
            if (!email.includes('@') || !email.includes('.')) {
                alert('Please enter a valid email address');
                return;
            }
            
            if (name.length < 2) {
                alert('Please enter a valid name');
                return;
            }
            
            alert('Message sent successfully!');
            this.reset();
        });
    }
});

function handleFunctionClick(func, role) {
    const workArea = document.getElementById('workArea');
    
    switch(func) {
        case 'Submit Donation':
            window.location.href = 'donation-form.html';
            break;
        case 'Apply as Volunteer':
            window.location.href = 'volunteering-form.html';
            break;
        default:
            workArea.innerHTML = `
                <h2>${func}</h2>
                <p>This functionality is under construction for ${role} role.</p>
            `;
    }
}