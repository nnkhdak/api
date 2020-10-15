<!DOCTYPE html>
<html>
	<body>
        <form action="/api/1.0.0/groups/1/users/2">
			<table>
				<tbody>
					<tr>
						<td>city</td>
						<td><input type="text" name="city" value="Tokyo"></td>
					</tr>
					<tr>
						<td>name</td>
						<td><input type="text" name="name" value="hoge"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="get"></td>
					</tr>
				</tbody>
			</table>
		</form>
		<hr>
		<form action="/api/groups/1/users/2" method="post">
			<table>
				<tbody>
					<tr>
						<td>city</td>
						<td><input type="text" name="city" value="Tokyo"></td>
					</tr>
					<tr>
						<td>name</td>
						<td><input type="text" name="name" value="hoge"></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="post"></td>
					</tr>
					<tr>
                        <td colspan="2"><input type="submit" name="_method" value="delete"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>
