<div id="update_avatar">
    <div class="card">
        <!-- Avatar Form -->
        <div class="card-body">

            {!! Form::open(['route' => ['update_avatar'], 'class' => 'form-horizontal form-material', 'role'
                               =>'form' , 'enctype' => 'multipart/form-data', 'data-toggle' => 'validator', 'id' => 'update-avatar-form']) !!}

            <div class="form-body">
                <div class="form-group cropper-img">
                    <div class="form-row">
                        <input type="hidden" class="crop-value" name="avatar" id="avatar"
                               value="{{$member->avatar}}"/>
                        <input type="hidden" class="crop-check" name="avatar_check" value="0"/>
                        <div class="col-md-7">
                            <div>
                                <canvas id="canvas">
                                    Your browser does not support the HTML5 canvas element.
                                </canvas>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="result"></div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-subtitle"></div>
                            <div class="form-control-feedback">
                                <small></small>
                            </div>

                            <div class="docs-preview clearfix">
                                <div class="img-preview preview-lg"></div>
                                <div class="img-preview preview-md"></div>
                                <div class="img-preview preview-sm"></div>
                                <div class="img-preview preview-xs"></div>
                            </div>
                            <div class="">
                                <div class="btn-group">
                                    <button id="btnCrop" type="button" class="btn btn-secondary btn-outline"
                                            data-method="getCroppedCanvas"
                                            data-ajax="'.admin_url('modules/croppedImageAction').'"
                                            title="Apply">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                      title="Apply">
                                                    <span class="fa fa-check"></span>
                                                </span>
                                    </button>
                                    <button id="btnRestore" type="button"
                                            class="btn btn-secondary btn-outline"
                                            data-method="reset">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                      title="Reset">
                                                    <span class="fas fa-sync-alt"></span>
                                                </span>
                                    </button>
                                    <label class="btn btn-secondary btn-outline btn-upload"
                                           for="avatar_input">
                                        <input type="file" class="sr-only crop-file"
                                               id="avatar_input"
                                               name="avatar_input" accept="image/*">
                                        <span class="docs-tooltip" data-toggle="tooltip"
                                              title="Import image">
                                                    <span class="fa fa-upload"></span>
                                                </span>
                                    </label>
                                    <button id="btnDestroy" type="button" class="btn btn-primary"
                                            data-method="destroy">
                                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                                      title="Destroy">
                                                    <span class="fa fa-power-off"></span>
                                                </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button id="btnRotateLeft" type="button"
                                            class="btn btn-secondary btn-outline"
                                            data-method="rotate" data-option="-45">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                      title="Rotate -45°">
                                                    <span class="fas fa-undo"></span>
                                                </span>
                                    </button>
                                    <button id="btnRotateRight" type="button"
                                            class="btn btn-secondary btn-outline"
                                            data-method="rotate" data-option="45">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                      title="Rotate 45°">
                                                    <span class="fas fa-undo fa-flip-horizontal"></span>
                                                </span>
                                    </button>
                                    <button id="btnRotateUpSideDown" type="button"
                                            class="btn btn-secondary btn-outline"
                                            data-method="rotateTo">
                                                    <span class="docs-tooltip" data-toggle="tooltip"
                                                          title="Rotate 180°"> 180° </span>
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button id="btnZoomIn" type="button" class="btn btn-success"
                                            data-method="zoom"
                                            data-option="0.1">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                      title="Zoom In">
                                                    <span class="fa fa-search-plus"></span>
                                                </span>
                                    </button>
                                    <button id="btnZoomOut" type="button" class="btn btn-success"
                                            data-method="zoom"
                                            data-option="-0.1">
                                                <span class="docs-tooltip" data-toggle="tooltip"
                                                      title="Zoom Out">
                                                    <span class="fa fa-search-minus"></span>
                                                </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-sm-12">
                    <button type="button" id="submit-avatar-form"
                            class="btn btn-success">@lang('layouts.buttons.update')</button>
                    <a class="btn btn-secondary edit-cancel"
                       href="{{ route('my_profile') }}">@lang('layouts.buttons.cancel')</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-12 form-group">
            <div class="col-sm-12">
            </div>
        </div>
    </div>
</div>
