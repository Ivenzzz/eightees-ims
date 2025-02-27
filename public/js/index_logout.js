handleLogout();

function handleLogout() {
    document.getElementById("logoutBtn").addEventListener("click", function() {
        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, logout!"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("../controllers/index_logout.php", { method: "POST" })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire("Logged out!", data.message, "success").then(() => {
                            window.location.href = "../index/index.php"; // Redirect to login page
                        });
                    }
                })
                .catch(error => {
                    Swal.fire("Error!", "Something went wrong.", "error");
                });
            }
        });
    });
}