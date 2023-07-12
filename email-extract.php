<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Extractor</title>
    <style>
        body {
            background-color: #f2f4f3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            border-radius: 5px;
            padding: 20px;
            width: 500px;
            text-align: center;
        }

        h1 {
            color: #0077b6;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        textarea {
            padding: 10px;
            border: none;
            border-bottom: 2px solid #ddd;
            font-size: 16px;
            margin-bottom: 20px;
            width: 70%;
            height: 120px;
            resize: none;
        }

        button {
            background-color: #0077b6;
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            background-color: #023e8a;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
            text-align: left;
            width: 70%;
        }

        li {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }

        .email {
            color: #0077b6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Extractor</h1>
        <form>
            <label for="inputBox">Input text:</label>
            <textarea id="inputBox" placeholder="Enter text with email addresses..."></textarea>
            <button type="button" onclick="extractEmails()">Extract Emails</button>
        </form>
        <ul id="emailList"></ul>
    </div>

    <script>
        const emailPattern = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/g;

        function extractEmails() {
            const userInput = document.getElementById('inputBox').value;
            const emails = userInput.match(emailPattern);
            const emailList = document.getElementById('emailList');
            emailList.innerHTML = '';
            emails.forEach(function(email) {
                const listItem = document.createElement('li');
                const emailNode = document.createTextNode(email);
                const emailSpan = document.createElement('span');
                emailSpan.classList.add('email');
                emailSpan.appendChild(emailNode);
                listItem.appendChild(emailSpan);
                emailList.appendChild(listItem);
            });
        }
    </script>
</body>
</html>
