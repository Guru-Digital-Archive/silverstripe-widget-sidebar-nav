<li class="$LinkingMode<%if $LinkingMode == "current"%> active<%end_if%><% if $Parent %> dropdown-submenu<% end_if %>">
    <a href="$Link" title="$Title.XML" >
        <% if $Children %>
        <span class="caret" data-toggle="dropdown"></span><% end_if %>$MenuTitle.XML
    </a>
    <% if $Children %>
    <div class="tab-content">
        <ol class="nav nav-pills nav-stacked tab-pane" role="menu">
            <% loop $Children %>
            <% include SidebarMenuItem %>
            <% if not $Last%>
            <li class="divider"></li>
            <% end_if %>
            <% end_loop %>
        </ol>
    </div>
    <% end_if %>
</li>