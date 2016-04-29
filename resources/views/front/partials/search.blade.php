{{ Form::open(['route' => 'search', 'method' => 'GET', 'class' => "navbar-form navbar-right custom-position-search", "role" => "search" ]) }}
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">

                <input type="text" class="form-control SearchBar" name="search" placeholder="Buscar...">
                <span class="input-group-btn">
                    <button class="btn btn-defaul SearchButton" type="submit">
                        <span class=" glyphicon glyphicon-search SearchIcon" ></span>
                    </button>
                </span>

            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
{{ Form::close() }}