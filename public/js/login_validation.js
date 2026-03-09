function validateLoginForm() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let isValid = true;
    
    document.getElementById('usernameError').innerHTML = '';
    document.getElementById('passwordError').innerHTML = '';
    
    if (username.trim() === '') {
        document.getElementById('usernameError').innerHTML = 'Username is required';
        isValid = false;
    }
    
    if (password.trim() === '') {
        document.getElementById('passwordError').innerHTML = 'Password is required';
        isValid = false;
    }
    
    return isValid;
}