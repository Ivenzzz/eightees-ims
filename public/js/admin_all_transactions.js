initDesignImageTooltip();
displayDownpaymentUpdateStatus();

function initDesignImageTooltip() {
    document.addEventListener("DOMContentLoaded", function () {
        let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        let popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });
}

function displayDownpaymentUpdateStatus() {
    document.addEventListener("DOMContentLoaded", function () {
        // Get the URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const errorMessage = urlParams.get("error");
        const successMessage = urlParams.get("success");

        if (errorMessage) {
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: errorMessage,
                confirmButtonColor: "#d33",
            }).then(() => {
                // Clear the URL parameters after displaying the message
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        }

        if (successMessage) {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: successMessage,
                confirmButtonColor: "#3085d6",
            }).then(() => {
                // Clear the URL parameters after displaying the message
                window.history.replaceState({}, document.title, window.location.pathname);
            });
        }
    });
}