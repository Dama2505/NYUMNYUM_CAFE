document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Retrieve user input
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    // Example login validation
    if (username === 'nyumnyum' && password === '2505') {
        alert('Login successful!');
        window.location.href = 'WEB.html'; // Redirect to WEB.html
    } else {
        alert('Invalid username or password. Please try again.');
    }
});
