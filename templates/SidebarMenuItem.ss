<div class="accordion-item panel panel-default $LinkingMode">
    <%-- 
    To have the menu item open its children instead of navigating to the page 
    set href="#collapse-$ID" 
    --%>
    <div class="panel-heading " role="tab" id="heading-$ID">
        <h4 class="panel-title $LinkingMode">
            <a href="$Link" id="title-$ID" class="<%if $LinkingMode != "current" && $LinkingMode != "section" %>collapsed <%end_if%>$LinkingMode" title="$Title.XML" data-toggle="collapse" data-target="#collapse-$ID" aria-controls="#collapse-$ID" data-parent="#accordion-$Level(1).ID">
               <% if $Children %><span class="toggle"><i class="glyphicon glyphicon-chevron-down"></i></span><% end_if %>
                $MenuTitle.XML
            </a>
        </h4>
    </div> 
    <% if $Children %>
    <div id="collapse-$ID" class="panel-collapse collapse <% if $LinkingMode == "current" || $LinkingMode == "section" %>in<% end_if %>" role="tabpanel" aria-labelledby="title-$ID" aria-expanded="<%if $LinkingMode == "current" %>true<% else %>false<% end_if %>">
         <ul class="nav nav-pills nav-stacked">
            <% loop $Children %>
            <li role="presentation"  class="<%if $LinkingMode == "current" %>active<%end_if%> $LinkingMode">
                <a href="$Link" title="$Title.XML" >
                    $MenuTitle.XML
                </a>
            </li>
            <% end_loop %>
        </ul>
    </div>
    <% end_if %>
</div>
