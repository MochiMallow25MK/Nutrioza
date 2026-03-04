function validateEmail(email) {
    let re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    let re = /^[0-9+\-\s()]{10,}$/;
    return re.test(phone);
}

function validatePassword(password) {
    return password.length >= 6;
}

function validateForm(formId, rules) {
    let form = document.getElementById(formId);
    let isValid = true;
    
    for(let field in rules) {
        let input = document.getElementById(field);
        let errorDiv = document.getElementById(field + 'Error');
        
        if(errorDiv) errorDiv.innerHTML = '';
        
        for(let rule of rules[field]) {
            if(rule === 'required' && input.value.trim() === '') {
                if(errorDiv) errorDiv.innerHTML = field + ' is required';
                isValid = false;
                break;
            }
            
            if(rule === 'email' && !validateEmail(input.value)) {
                if(errorDiv) errorDiv.innerHTML = 'Invalid email format';
                isValid = false;
                break;
            }
            
            if(rule === 'phone' && !validatePhone(input.value)) {
                if(errorDiv) errorDiv.innerHTML = 'Invalid phone format';
                isValid = false;
                break;
            }
            
            if(rule === 'password' && !validatePassword(input.value)) {
                if(errorDiv) errorDiv.innerHTML = 'Password must be at least 6 characters';
                isValid = false;
                break;
            }
        }
    }
    
    return isValid;
}