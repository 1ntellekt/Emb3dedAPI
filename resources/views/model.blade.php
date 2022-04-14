<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web 3D viewer</title>
    <style type="text/css">
        model-viewer { 
            height: calc(100vh - 30px);
            width: calc(100vw - 30px);
        }
       </style>
</head>
<body>
    <body>
        <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.js"></script>
        <script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
        <model-viewer ar src="{{$url}}" auto-rotate camera-controls alt="Chair" background-color="#455A64">
        </model-viewer>   
</body>
</html>