<script type="text/template" data-grid="suspension" data-template="results">

	<% _.each(results, function(r) { %>

		<tr>
			<td><input content="id" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="{{ URL::toAdmin('echineselearning/suspensions/<%= r.id %>/edit') }}"><%= r.start_date %></a></td>
			<td><%= r.end_date %></td>
			<td><%= r.duration %></td>
			<td><%= r.desc %></td>
			<td><%= r.cancelled ? '<span class="label label-danger">{{{ trans("kitbs/echineselearning::suspensions/table.show_disabled") }}}</span>' : '<span class="label label-success">{{{ trans("kitbs/echineselearning::suspensions/table.show_enabled") }}}</span>' %></td>
			<td><%= r.last_updated %> <small class="text-muted"><%= r.last_updated_when %></small></td>
		</tr>

	<% }); %>

</script>
