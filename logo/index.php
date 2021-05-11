<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">

</head>
<body>
    <div class="container">

    <div class="row m-3">
        <legend>Repositorio de Logo<legend>
    </div>

<?php

    $path = 'imagens';
    $list = dir($path);

    while($array = $list -> read()){
        if($array != "." && $array != ".."){
            $diretorio[] = $array;
        }
    }
        $list->close();

        print "<div class=\"row\">";
    foreach ($diretorio as $key => $value) {

        if($value != "." && $value != ".."){

            print "
                    <div class='col-md-3 mt-4 mb-4 text-center img-thumbnail'>
                        <a href='".$path."/".$value."'><img class='mt-4 mb-4 mx-auto' width='150' src='".$path."/".$value."' alt='".substr(str_replace(array(",", "-"), " ", $value), 0, -4)."'></a>
                    </div>  ";
            if((($key+1) % 4) === 0){
                print "<div class=\"row col-md-12\">
   
                </div>";
            }
        }

    }
    
    print "</div>";



?>

        <div class="row>">
            <div class="col-md-12 text-center">
                <p>2019 copyright</p>
            </div>
            
        </div>
             
</div>
       
</body>
</html>