{{ Form::open(['route' => 'index', 'method' => 'GET', 'class' => "navbar-form navbar-right custom-position-search", "id" => "searchForm", "role" => "search" ]) }}
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <input type="text" class="form-control SearchBar" id="searchText" name="search" placeholder="Buscar..." value="{{ (Request::get('type') == "2") ? Request::get('search') : null }}">
                <input type="hidden" name="type" value="2">
                    <span class="input-group-btn">
                        <button class="btn btn-defaul SearchButton" type="submit">
                            <span class=" glyphicon glyphicon-search SearchIcon" ></span>
                        </button>
                    </span>

            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
{{ Form::close() }}