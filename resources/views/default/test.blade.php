<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
</head>
<body>
	<div>default theme</div>
	<div>
		<table>
			<tr>
				<th>分单</th>
				<th>总单</th>
				<th>件数</th>
				<th>重量</th>
				<th>体积</th>
			</tr>
			@foreach($hawbs as $hawb)
			<tr>
				<td>{{ $hawb->hawb }}</td>
				<td>{{ $hawb->mawb }}</td>
				<td>{{ $hawb->num }}</td>
				<td>{{ $hawb->gw }}</td>
				<td>{{ $hawb->cbm }}</td>
			</tr>
			@endforeach
		</table>
		<div>
			{{ $hawbs->render() }}
		</div>
	</div>
</body>
</html>