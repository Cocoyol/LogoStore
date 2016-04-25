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
        $(document).on('ready', function() {

            var footerTemplate = '<div class="file-thumbnail-footer">' +
                    '   <div class="file-footer-caption" title="{caption}">{caption}</div>' +
                    '   {progress}' +
                    '   <div style="margin:20px 0">' +
                    '       <input class="form-control image-name" value="" placeholder="Nombre...">' +
                    '       <textarea class="form-control image-desc" placeholder="Descripci&oacute;n..." style="margin:5px 0" ></textarea>' +
                    '   </div>' +
                    '   {actions}' +
                    '</div>';

            $("#images").fileinput({

                uploadUrl: "{{ route('logos.images_post', $logo)  }}",

                language: "es",
                overwriteInitial: false,
                allowedFileTypes: ["image"],
                layoutTemplates: {footer: footerTemplate},
                uploadExtraData: function(previewId, index) {

                    var currPreview = $('#'+previewId)
                    var imgName = currPreview.find('.image-name').val();
                    var imgDesc = currPreview.find('.image-desc').val();
                    var obj = {_token: '{{ csrf_token() }}', name: imgName, description: imgDesc };

                    return obj;
                }
            });

            $("#images").on('fileuploaded', function(e, data, previewId, index){
                console.log(e);
                console.log(data);
                console.log(previewId);
                console.log(index);
            })
        });
    </script>
@endsection