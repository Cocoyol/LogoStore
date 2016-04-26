@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/admin/css/fileinput.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Im&aacute;genes</div>
                    <div class="panel-body">

                        <label class="control-label">Seleccionar Im&aacute;genes</label>
                        <input type="file" id="images" class="file-loading" multiple="true"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/fileinput_locale_es.js') }}"></script>
    <script>
        var images;
        var token = "{{ csrf_token() }}";

        function fileinput_init() {
            var iptImages = $("#images");
            var footerTemplate = '<div class="file-thumbnail-footer">' +
                    '   <div class="file-footer-caption" title="{caption}">{caption}</div>' +
                    '   {progress}' +
                    '   <div style="margin:20px 0">' +
                    '       <input class="form-control image-name" value="{TAG_IMAGE_NAME}" placeholder="Nombre...">' +
                    '       <textarea class="form-control image-desc" placeholder="Descripci&oacute;n..." style="margin:5px 0" >{TAG_IMAGE_DESCRIPTION}</textarea>' +
                    '   </div>' +
                    '   {actions}' +
                    '</div>';

            //images.initialPreviewThumbTags["{TOKEN}"] = token;

            console.log(images);

            iptImages.fileinput({
                uploadUrl: "{{ route('logos.images.create', $logo)  }}",

                language: "es",
                dropZoneEnabled: false,
                overwriteInitial: false,
                allowedFileTypes: ["image"],
                layoutTemplates: {footer: footerTemplate},
                previewThumbTags: {
                    '{TAG_IMAGE_NAME}': '',
                    '{TAG_IMAGE_DESCRIPTION}': ''
                },
                initialPreview: images.initialPreview,
                initialPreviewConfig: images.initialPreviewConfig,
                initialPreviewThumbTags: images.initialPreviewThumbTags,
                deleteExtraData: {_token: token},
                otherActionButtons: '<button type="button" class="kv-file-edit btn btn-xs btn-default hidden" title="Edit" {dataKey}>' +
                    '   <i class="glyphicon glyphicon-save"></i>' +
                    '</button>',
                uploadExtraData: function(previewId, index) {
                    var currPreview = $('#'+previewId);
                    var imgName = currPreview.find('.image-name').val();
                    var imgDesc = currPreview.find('.image-desc').val();
                    return {_token: token, name: imgName, description: imgDesc};
                }
            });

            $(document).on('click', '.kv-file-edit', function(e) {
                $(this).addClass('hidden');
                var name = $(this).closest('.file-thumbnail-footer').find('.image-name');
                var desc = $(this).closest('.file-thumbnail-footer').find('.image-desc');
                alert(name.val()+" "+desc.val());
                var url = "{{ route('logos.images.update', ':IMAGE_ID') }}".replace(':IMAGE_ID', $(this).data('key'));
                $.post(url,{ _token: token, name: name.val(), description: desc.val() },function(response){
                    console.log(response);
                });
            });

            $(document).on('change', '.file-preview-initial .image-name', function(){
                $(this).closest('.file-thumbnail-footer').find('.kv-file-edit').removeClass('hidden');
            });

            $(document).on('change', '.file-preview-initial .image-desc', function(){
                $(this).closest('.file-thumbnail-footer').find('.kv-file-edit').removeClass('hidden');
            });
        }

        $(document).on('ready', function() {
            $.post("{{ route('logos.images.list', $logo->id) }}",{ _token: token },function(response){
                images = response;
                fileinput_init();
            }, 'json');
        });
    </script>
@endsection