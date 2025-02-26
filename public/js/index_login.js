handleLogin();


function handleLogin() {
    document.querySelector("form").addEventListener("submit", async function(event) {
        event.preventDefault(); // Prevent default form submission
    
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;
        let errorMessageDiv = document.getElementById("error-message");
    
        let response = await fetch("../controllers/index_login.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ username, password })
        });
    
        let result = await response.json();
    
        if (result.status === "success") {
            errorMessageDiv.style.display = "none"; // Hide error message
            
            // Show SweetAlert success modal
            Swal.fire({
                icon: 'success',
                title: 'Login Successful',
                text: 'Redirecting to dashboard...',
                timer: 2000, // Auto-close after 2 seconds
                showConfirmButton: false
            }).then(() => {
                window.location.href = "../admin/index.php"; // Redirect on success
            });
        } else {
            errorMessageDiv.innerText = result.message;
            errorMessageDiv.style.display = "block"; // Show error message
        }
    });
}