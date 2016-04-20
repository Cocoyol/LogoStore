<script type="text/javascript" src="{{ asset('assets/admin/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
        $('select.listKeywords').select2({
            theme: "bootstrap",
            language: "es",
            placeholder: "Seleccione las palabras clave..."
        });
    });
</script>