<!doctype html>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="/css/ezamastilus.css" rel="stylesheet">
    <title>ne néz ide</title>
  </head>
  <body>
    <div class="p-3 mb-3">
        <input type="file" id="csvFileInput" accept=".csv">
    <button id="convertButton">Convert and Send to Discord</button>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
  $(document).ready(function() {
            $('#convertButton').on('click', function() {
                // Get the selected CSV file
                const fileInput = document.getElementById('csvFileInput');
                const file = fileInput.files[0];
        
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const csvContent = e.target.result;
        
                        // Convert CSV to JSON
                        const jsonArray = csvJSON(csvContent);
        
                        // Send JSON to Discord webhook
                    };
        
                    reader.readAsText(file);
                } else {
                    alert('Please select a CSV file.');
                }
            });
        
            function csvJSON(csv) {
                const lines = csv.split('\n');
                const result = [];
                const headers = lines[0].split(',');
                let codes ="";
        
                for (let i = 1; i < lines.length; i++) {
                    
                    const currentline = lines[i].split(',');
        
                    if(currentline[0].replace('"','').replace('"','').replace(/(\r\n|\n|\r)/gm, "") != ''){
                        codes += currentline[0].replace('"','').replace('"','').replace(/(\r\n|\n|\r)/gm, "")+";";
                    }
        
                }
                
                const words = codes.split(';');
                let wordsCount = words.length;
                let messageCount = Math.round(wordsCount/ 400);
                
                for(let i = 0; i < messageCount; i++){
                    
                    let codesOkay = "";
                    for(let l  = 0; l < 400; l++){
                        if(words[(i+1)*(l+1)] != null){
                        codesOkay += words[(i+1)*(l+1)]+";";
                        }
                    }
                    sendToDiscord(codesOkay);
                }
                return codes;
            }
        
     function sendToDiscord(jsonArray) {
    // Discord Webhook URL
    //Bolond: https://discord.com/api/webhooks/1181230412735979623/RPbzoIoglGEwJ-n73iV0sTQjlgJFAY5YlOGfjmkcE5liU7QE9YM3eO7I5AhSopDhgkbT
    var webhookUrl = "https://discord.com/api/webhooks/1181330916736520253/M5_1FyabUf6VKftE2Oi4jWIVhadaLoKu7Ca2OjXhM1pIMQGdklXDjWYedrSwmpdXt_tH"; //message-loader webhook

        var request = new XMLHttpRequest();
        request.open("POST", webhookUrl);
        request.setRequestHeader('Content-type', 'application/json');
        var params = {
        embeds:[{"color": null, "description":jsonArray}]
        }
        request.send(JSON.stringify(params));
        console.log(JSON.stringify(jsonArray));
        }
        });
        </script>
</body>
</html>