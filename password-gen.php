<!DOCTYPE html>
<html>
<head>
    <title>Password Generator</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }
        
        h1 {
            color: #0077ff;
            margin-bottom: 50px;
        }
        
        label {
            display: block;
            margin-bottom: 20px;
            font-size: 24px;
            color: #555;
            text-align: left;
            margin-left: 30px;
            position: relative;
            padding-left: 60px;
            cursor: pointer;
            user-select: none;
        }
        
        input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 30px;
            width: 30px;
            background-color: #eee;
            border-radius: 50%;
        }
        
        label:hover .checkmark {
            background-color: #ccc;
        }
        
        label .checkmark:after {
            content: " ✓";
            /* position: absolute; */
            display: none;
            background-color: #0077ff;
            border-radius: 25px;
            text-align: center;
        }
        
        input:checked + .checkmark:after {
            display: block;
            background-color: #2196F3;
        }
        
        input[type="range"] {
            width: 100%;
            height: 2px;
            background-color: #eee;
            outline: none;
            -webkit-appearance: none;
            appearance: none;
            margin-bottom: 30px;
        }
        
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            background-color: #0077ff;
            border-radius: 50%;
            cursor: pointer;
        }
        
        button {
            background-color: #0077ff;
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: all .3s ease;
        }
        
        button:hover {
            background-color: #0057b8;
        }	
        
        input {
            margin: 20px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 70%;
            max-width: 600px;
            font-size: 20px;
            text-align: center;
            outline: none;
        }
    </style>
</head>
<body>
    <h1>Password Generator</h1>
    
    <label for="slider">
        Password Length: <span id="length-output">8</span>
        <input type="range" id="slider" min="8" max="32" value="8">
    </label>
    
    <label for="alphabet-characters">
        <input type="checkbox" id="alphabet-characters" checked>
        <span class="checkmark"></span>
        Alphabetic Characters
    </label>
    
    <label for="numeric-characters">
        <input type="checkbox" id="numeric-characters" checked>
        <span class="checkmark"></span>
        Numeric Characters
    </label>
    
    <label for="special-characters">
        <input type="checkbox" id="special-characters" checked>
        <span class="checkmark"></span>
        Special Characters
    </label>
    
    <button id="generate-password">Generate Password</button>
    
    <input type="text" id="password" readonly>
    
    <button id="copy-password">Copy Password</button>
    
    <script>
        const generatePassword = () => {
            const lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
            const uppercaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            const numberChars = "0123456789";
            const specialChars = "!@#$%^&*";
            
            let password = "";
            
            const charSets = [];
            
            if (document.getElementById("alphabet-characters").checked) {
                charSets.push(lowercaseChars);
                charSets.push(uppercaseChars);
            }
            
            if (document.getElementById("numeric-characters").checked) {
                charSets.push(numberChars);
            }
            
            if (document.getElementById("special-characters").checked) {
                charSets.push(specialChars);
            }
            
            for(let i=0; i<document.getElementById("slider").value; i++) {
                const randomCharSetIndex = Math.floor(Math.random() * charSets.length);
                const randomCharSet = charSets[randomCharSetIndex];
                
                const randomCharIndex = Math.floor(Math.random() * randomCharSet.length);
                const randomChar = randomCharSet[randomCharIndex];
                
                password += randomChar;
            }
            
            return password;
        };
        
        document.getElementById("slider").addEventListener("input", () => {
            document.getElementById("length-output").textContent = document.getElementById("slider").value;
        });
        
        document.getElementById("generate-password").addEventListener("click", () => {
            const passwordInput = document.getElementById("password");
            passwordInput.value = generatePassword();
        });
        
        document.getElementById("copy-password").addEventListener("click", () => {
            const passwordInput = document.getElementById("password");
            passwordInput.select();
            document.execCommand("copy");
            alert("Password copied to clipboard!");
        });
    </script>
</body>
</html>
