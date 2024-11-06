function handleLogin(event) {
    event.preventDefault(); // Prevents form from submitting the traditional way

    // Assuming validation is done here
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Perform login validation logic here (e.g., API call for authentication)
    // For now, assume login is always successful
    console.log("Email:", email, "Password:", password);

    // Redirect to dashboard
    window.location.href = "/admin/admin.html";
}
