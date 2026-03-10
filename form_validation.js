function validateDonationForm() {
    let isValid = true;
    
    document.getElementById('nameError').innerHTML = '';
    document.getElementById('emailError').innerHTML = '';
    document.getElementById('phoneError').innerHTML = '';
    document.getElementById('typeError').innerHTML = '';
    document.getElementById('descError').innerHTML = '';
    
    let name = document.getElementById('donor_name').value;
    let email = document.getElementById('donor_email').value;
    let phone = document.getElementById('donor_phone').value;
    let type = document.getElementById('donation_type').value;
    let description = document.getElementById('description').value;
    
    if (name.trim() === '') {
        document.getElementById('nameError').innerHTML = 'Name is required';
        isValid = false;
    }
    
    if (email.trim() === '') {
        document.getElementById('emailError').innerHTML = 'Email is required';
        isValid = false;
    } else if (!email.includes('@') || !email.includes('.')) {
        document.getElementById('emailError').innerHTML = 'Enter a valid email';
        isValid = false;
    }
    
    if (phone.trim() === '') {
        document.getElementById('phoneError').innerHTML = 'Phone is required';
        isValid = false;
    }
    
    if (type === '') {
        document.getElementById('typeError').innerHTML = 'Select donation type';
        isValid = false;
    }
    
    if (description.trim() === '') {
        document.getElementById('descError').innerHTML = 'Description is required';
        isValid = false;
    }
    
    return isValid;
}

function validateVolunteerForm() {
    let isValid = true;
    
    document.getElementById('nameError').innerHTML = '';
    document.getElementById('emailError').innerHTML = '';
    document.getElementById('phoneError').innerHTML = '';
    document.getElementById('availError').innerHTML = '';
    document.getElementById('skillsError').innerHTML = '';
    
    let name = document.getElementById('full_name').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let availability = document.getElementById('availability').value;
    let skills = document.getElementById('skills').value;
    
    if (name.trim() === '') {
        document.getElementById('nameError').innerHTML = 'Name is required';
        isValid = false;
    }
    
    if (email.trim() === '') {
        document.getElementById('emailError').innerHTML = 'Email is required';
        isValid = false;
    } else if (!email.includes('@') || !email.includes('.')) {
        document.getElementById('emailError').innerHTML = 'Enter a valid email';
        isValid = false;
    }
    
    if (phone.trim() === '') {
        document.getElementById('phoneError').innerHTML = 'Phone is required';
        isValid = false;
    }
    
    if (availability.trim() === '') {
        document.getElementById('availError').innerHTML = 'Availability is required';
        isValid = false;
    }
    
    if (skills.trim() === '') {
        document.getElementById('skillsError').innerHTML = 'Skills are required';
        isValid = false;
    }
    
    return isValid;
}