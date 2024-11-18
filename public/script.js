// JavaScript can be added here for form validation, AJAX submission, etc.
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;
    // Simple validation
    if (username === '' || password === '') {
        // alert('Please fill in all fields for login.');
    } else {
        // Perform your login logic here (AJAX call, etc.)
        // alert(`Logging in with Username: ${username} and Password: ${password}`);
    }
});

document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const fullname = document.getElementById('signup-fullname').value;
    const contact = document.getElementById('signup-contact').value;
    const username = document.getElementById('signup-username').value;
    const password = document.getElementById('signup-password').value;
    // Simple validation
    if (fullname === '' || contact === '' || username === '' || password === '') {
        // alert('Please fill in all fields for signup.');
    } else {
        // Perform your signup logic here (AJAX call, etc.)
        // alert(`Signing up with Full Name: ${fullname}, Contact: ${contact}, Username: ${username}, and Password: ${password}`);
    }
});

document.getElementById('signup-link').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.login-container').style.display = 'none';
    document.querySelector('.signup-container').style.display = '';
});
document.getElementById('login-link').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.login-container').style.display = '';
    document.querySelector('.signup-container').style.display = 'none';
});