<div class="side-accordion accordion">
    <div class="panel panel-default side-bar-title">
        <div class="panel-heading">
            <h3 class="panel-title">$Title.XML</h3>
            <button type="button" class="btn btn-default side-bar-collapse-btn collapsed" data-toggle="collapse" data-target="#toggle-accordion-$Menu().First().Level(1).ID">
                <i class="glyphicon glyphicon-chevron-left"></i>
                <i class="glyphicon glyphicon-align-justify"></i>
            </button>
        </div>
    </div>
    <div class="collapse width side-bar-collapse toggle-accordion" id="toggle-accordion-$Menu().First().Level(1).ID">
        <div class="panel-group" role="tablist" id="accordion-$Menu().First().Level(1).ID">
            <% loop Menu() %>
            <% include SidebarMenuItem %>
            <% end_loop %>
        </div>
    </div>
</div>

