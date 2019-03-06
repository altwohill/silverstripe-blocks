<section class="$EvenOdd $CSSClass <% if $ShowDivider %>divider<% end_if %>">
        <div class="row">
            <% loop $BootStrapBlocks %>
                <div class="$BootStrapColumnClass $CSSClass $ShortClassName">$FormattedBlock</div>
            <% end_loop %>
        </div>
</section>
