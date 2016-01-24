<div class="$CSSClass">
    <% if $ShowTitle %><h2>$Title</h2><% end_if %>
    <div class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <% loop $Slides %>
                <div class="item<% if $First %> active<% end_if %>"><% if $Link %><a
                        href="$Link.LinkURL" $Link.TargetAttr >$Image</a><% else %>$Image<% end_if %></div>
            <% end_loop %>
        </div>
    </div>
</div>
