<% if $ShowTitle %><h2><a href="$Blog.Link">$Title</a></h2><% end_if %>
$Content
<% with $Blog.BlogPosts.First %>

        <h3>
            <a href="$Link" title="<%t Blog.ReadMoreAbout "Read more about '{title}'..." title=$Title %>">
                <% if $MenuTitle %>$MenuTitle
                <% else %>$Title<% end_if %>
            </a>
        </h3>

        <p class="post-image">
            <a href="$Link" <%t Blog.ReadMoreAbout "Read more about '{title}'..." title=$Title %>>
                $FeaturedImage.setWidth(300)
            </a>
        </p>

        <% if $Summary %>
        <p>$Summary
        <% else %>
        <p>$Excerpt
        <% end_if %>
        </p>
        <p><a href="$Link" class="button">Read more</a></p>

<% end_with %>
