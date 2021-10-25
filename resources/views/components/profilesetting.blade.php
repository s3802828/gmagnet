<div class="container-fluid">
    <div class="container">
        <h3>Setting</h3>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 ml-auto mr-auto" style="font-size: 120%">Location</div>
                <div class="col-sm-9 ml-auto mr-auto">
                    <form id="locationPermit" action="" method="post">
                        @csrf
                        <input id="getLocation" type="checkbox" name="locationConfirmation" data-toggle="toggle" data-onstyle="outline-dark" @if(Auth::user()->location==null) @else checked @endif>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery for submitting form -->
    <script>
        $('#getLocation').change(function() {
            if ($(this).prop('checked') == true) {
                var state = "on";
            } else {
                var state = "off";
            }
            $('#permiHeader').html('Turn ' + state + ' detecting nearby user location');
            $('#userAgreement').modal('show');
        });
        $(document).on('click', '#agreeLocation', function() {
            $('#locationPermit').submit();
        });
        $(document).on('click', '#closeLocation', function() {
            $('#getLocation').bootstrapToggle('toggle');
        });
    </script>
    <!-- Modal asking for permisson -->
    <div class="modal fade" id="userAgreement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permiHeader"></h5>
                </div>
                <div class="modal-body">
                    @if(Auth::user()->location==null)
                    <div>By clicking agree, you would allow us to track your location. Do you want to proceed?</div>
                    @else
                    <div>Turning location detection off means that you can no longer find nearby user. Do you want to proceed?</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button id="closeLocation" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="agreeLocation" type="button" class="btn btn-primary">Agree</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->
</div>