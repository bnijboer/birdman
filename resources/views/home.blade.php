<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Birdman</title>
        <link href="" rel="stylesheet">
        <script src="js/app.js"></script>
    </head>
    <body>
        <script>
            window.onload = () => {
                let color = '2+4';
                let habitat = '5+3';
                
                const response = axios.get(`/search?color=${color}&habitat=${habitat}`).then((response) => {
                    console.log(response.data)
                });
            }
        </script>    
    </body>
</html>
