    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/lib/chosen/chosen.jquery.min.js"></script>
    <script>
        $('script[src="assets/js/main.js"]').attr('src',$(location).attr('origin') + '/assets/js/main.js');
        $('script[src="assets/js/lib/chosen/chosen.jquery.min.js"]').attr('src',$(location).attr('origin') + '/assets/js/lib/chosen/chosen.jquery.min.js');
    </script>