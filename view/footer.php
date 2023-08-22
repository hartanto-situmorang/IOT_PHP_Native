</main>
</div>
<!-- MDB -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Get the current URL
        var currentURL = window.location.href;

        // Find the button that matches the current URL and add the 'active' class to it
        $('.nav-item a').each(function() {
            if ($(this).attr('href') === currentURL) {
                $(this).addClass('active');
            }
        });
    });


    setInterval(function() {
        $.ajax({
            url: 'Temp/cari',
            method: 'GET',
            success: function(response) {
                var data = JSON.parse(response);
                $('#flashMessageContainer').html(data.message);
                window.location.href = data.redirectUrl;
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }, 2000);
</script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
</body>

</html>