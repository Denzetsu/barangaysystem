<!-- Pag Table plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

<script>
    $(document).ready(function() {
        $('.update-btn').on('click', function() {
            $('#updateModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.find("td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10), td:eq(11), td:eq(12), td:eq(13)").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            // Adjusting the IDs for consistency and converting ID to integer
            $('#update_id').val(parseInt(data[0], 10));
            $('#first_name').val(data[1]);
            $('#middle_name').val(data[2]);
            $('#last_name').val(data[3]);
            $('#suffix_name').val(data[4]);
            $('#gender').val(data[5]); // Adjusted ID for consistency
            $('#dob').val(data[6]);
            $('#bplace').val(data[7]);
            $('#work').val(data[8]);
            $('#vs').val(data[9]);
            $('#barangay').val(data[10]);
            $('#email').val(data[11]);
            $('#pass').val(data[12]);
            $('#fh').val(data[13]);
        });
    });
</script>