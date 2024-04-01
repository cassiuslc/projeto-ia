<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Chatbot - Projeto Fucapi</title>
		@vite(['resources/js/app.js'])
		@vite(['resources/css/app.css'])
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<body class="bg-gray-200">
		<div class="section section-lg pt-5 pt-md-7">
			<div id="app">
				<chat-bot />
			</div>
		</div>
	</body>
</html>