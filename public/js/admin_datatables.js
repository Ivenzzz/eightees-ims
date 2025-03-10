initializeDataTable("transactionsTable");
initializeDataTable("materialsDataTable");
initializeDataTable("customersTransactionsTable");

function initializeDataTable(tableId) {
    $(document).ready(function() {
        $('#' + tableId).DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable search filter
            "ordering": true, // Enable column sorting
            "info": true, // Show info (e.g., "Showing 1 to 10 of 50 entries")
            "lengthMenu": [5, 10, 25, 50, 100], // Dropdown to select number of rows
            "stateSave": true, // Remember table state (pagination, sorting, etc.)
            "responsive": true, // Enable responsive table for different screen sizes
            "language": {
                "search": "Search:", // Custom label for search
                "lengthMenu": "Show _MENU_ entries",
                "emptyTable": "No records found" // Custom message for an empty table
            }
        });
    });
}

