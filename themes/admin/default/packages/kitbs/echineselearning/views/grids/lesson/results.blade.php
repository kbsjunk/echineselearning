<script type="text/template" data-grid="lesson" data-template="results">

	<% _.each(results, function(r) { %>

		<tr>
			<td><input content="id" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="{{ URL::toAdmin('echineselearning/lessons/<%= r.id %>/edit') }}"><%= r.lesson_date %></a></td>
			<td><%= r.lesson_time %></td>
			<td><%= r.lesson_when %></td>
			<td><a href="#" data-filter="teacher:<%= r.teacher %>" data-label="teacher::<%= r.teacher %>"><%= r.teacher %></a></td>
			<td><%= r.cancelled ? '<span class="label label-danger">{{{ trans("kitbs/echineselearning::lessons/table.show_disabled") }}}</span>' : '<span class="label label-success">{{{ trans("kitbs/echineselearning::lessons/table.show_enabled") }}}</span>' %></td>
			<td><%= r.last_updated %> <small class="text-muted"><%= r.last_updated_when %></small></td>
		</tr>

	<% }); %>

</script>
