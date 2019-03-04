<section class="$EvenOdd $CSSClass <% if $ShowDivider %>divider<% end_if %>">
        <div class="row">
            <% loop $BootStrapBlocks %>
                <div class="$BootStrapColumnClass $CSSClass $ClassName">$FormattedBlock</div>
            <% end_loop %>
        </div>
</section>