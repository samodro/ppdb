<!-- jQuery -->


    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        var peserta = <?php echo json_encode(@$peserta) ?>;          
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
        $('#datepicker').datepicker();
        if(peserta!=null || peserta!='')
        {
            $.each(peserta, function(){		
                $('#datepicker' + this.id_peserta).datepicker();
            });            
        }
        
    });
    </script>      

</body>

</html>