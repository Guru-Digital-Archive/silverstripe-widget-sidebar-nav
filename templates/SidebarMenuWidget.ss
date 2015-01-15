<div class="panel panel-default">
    <div class="panel-body">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".side-nav">
                    <i class="icon"></i>
                    <span class="icon-bars">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </span>
                </button>
            </div>
            <div class="side-nav collapse">
                <ol class="nav nav-pills nav-stacked">
                    <% loop Menu() %>
                    <% include SidebarMenuItem %>
                    <% end_loop %>
                </ol>
            </div>
        </nav>
    </div>
</div>