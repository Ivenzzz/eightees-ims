initMaterialsTable();

function initMaterialsTable() {
    $(document).ready(function() {
        $('#materialsDataTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50, 100], // Dropdown for items per page
            "order": [[0, "desc"]], // Sort first column (index 0) in DESC order
            "language": {
                "search": "Search materials:",
                "lengthMenu": "Show _MENU_ entries",
                "emptyTable": "No materials found." // Custom message for an empty table
            }
        });
    });
}
