<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .resume-container {
            max-width: 600px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .resume-list {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .resume-item {
            flex: 0 0 calc(33.33% - 10px);
            border: 2px solid transparent;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .resume-item.selected {
            border-color: #007bff;
        }

        .resume-item img {
            width: 100%;
            height: auto;
        }

        .download-btn {
            display: block;
            width: 100%;
            padding: 10px 20px;
            margin-top: 20px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .download-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="resume-container">
        <h1>Select a Resume</h1>
        <div class="resume-list">
            <div class="resume-item" onclick="selectResume(this)">
                <img src="images/resume1.png" alt="Resume 1">
            </div>
            <div class="resume-item" onclick="selectResume(this)">
                <img src="images/resume2.png" alt="Resume 2">
            </div>
            <div class="resume-item" onclick="selectResume(this)">
                <img src="images/resume3.png" alt="Resume 3">
            </div>
        </div>
        <button id="downloadBtn" class="download-btn" disabled>Download Resume</button>
    </div>
    
    <script>
        function selectResume(resumeItem) {
            const resumeItems = document.querySelectorAll('.resume-item');
            resumeItems.forEach(item => item.classList.remove('selected'));
            resumeItem.classList.add('selected');
            const downloadBtn = document.getElementById('downloadBtn');
            downloadBtn.disabled = false;
        }
    </script>
</body>
</html>
